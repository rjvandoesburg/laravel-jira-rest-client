<?php

namespace Rjvandoesburg\Jira\Models;

use Rjvandoesburg\Jira\Traits\HasAttributes;

abstract class JiraModel
{
    use HasAttributes;

    public function __construct($response)
    {
        foreach ($response as $property => $value) {
            $this->{$property} = $value;
        }

        $this->syncOriginal();
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

}