<?php

namespace Rjvandoesburg\Jira\Client;

use Rjvandoesburg\Jira\Client\Query\Builder as JqlBuilder;
use Rjvandoesburg\Jira\Client\Grammar\JqlGrammar as QueryGrammar;
use Illuminate\Database\Connection;

class JiraConnection extends Connection
{
    /**
     * Get the default query grammar instance.
     *
     * @return QueryGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return new QueryGrammar;
    }

    /**
     * Get a new query builder instance.
     *
     * @return JqlBuilder
     */
    public function query()
    {
        return new JqlBuilder(
            $this, $this->getQueryGrammar(), $this->getPostProcessor()
        );
    }

    /**
     * Bind values to their parameters in the given statement.
     *
     * @param  \PDOStatement $statement
     * @param  array  $bindings
     * @return void
     */
    public function bindValues($statement, $bindings)
    {

    }

    /**
     * Get the database connection name.
     *
     * @return string|null
     */
    public function getName()
    {
        return 'jira';
    }

    /**
     * Get the PDO driver name.
     *
     * @return string
     */
    public function getDriverName()
    {
        return 'jira';
    }

}