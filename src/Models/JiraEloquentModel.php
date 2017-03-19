<?php

namespace Atlassian\JiraRest\Models;

use Illuminate\Database\Eloquent\Model;
use Atlassian\JiraRest\Client\Eloquent\Builder;
use Atlassian\JiraRest\Client\Eloquent\Relationships\HasMany;
use Atlassian\JiraRest\Client\JiraConnection;
use Atlassian\JiraRest\Client\Query\Builder as QueryBuilder;

abstract class JiraEloquentModel extends Model
{

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static function fromJira($response)
    {
        $model = new static;

        foreach ($response as $property => $value) {
            $model->{$property} = $value;
        }

        $model->syncOriginal();

        return $model;
    }

    /**
     * Get the database connection for the model.
     *
     * @return \Illuminate\Database\Connection
     */
    public function getConnection()
    {
        return new JiraConnection(function() {});
    }

    /**
     * Resolve a connection instance.
     *
     * @param  string|null  $connection
     * @return \Illuminate\Database\Connection
     */
    public static function resolveConnection($connection = null)
    {
        return new JiraConnection(function(){});
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     *
     * @return Builder
     */
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    /**
     * Get a new query builder instance for the connection.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newBaseQueryBuilder()
    {
        $connection = $this->getConnection();

        return new QueryBuilder(
            $connection, $connection->getQueryGrammar(), $connection->getPostProcessor()
        );
    }


    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        $instance = $this->newRelatedInstance($related);

        $foreignKey = $foreignKey ?: $this->getForeignKey();

        $localKey = $localKey ?: $this->getKeyName();

        return new HasMany(
            $instance->newQuery(), $this, $foreignKey, $localKey
        );
    }

    /**
     * Create a new model instance that is existing.
     *
     * @param  array  $attributes
     * @param  string|null  $connection
     * @return static
     */
    public function newFromBuilder($attributes = [], $connection = null)
    {
        $model = $this->newInstance([], true);
        $model->setRawAttributes((array) $attributes, true);

        $model->setConnection('jira');

        return $model;
    }
}