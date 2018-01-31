<?php

namespace Atlassian\JiraRest\Requests;

use Illuminate\Contracts\Support\Arrayable;

abstract class AbstractParameters implements Arrayable
{
    /**
     * RequestParametersBase constructor.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        foreach ($parameters as $key => $value) {
            $key = camel_case($key);
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Static method of the constructor
     *
     * @param array $parameters
     *
     * @return static
     */
    public static function create(array $parameters = [])
    {
        return new static($parameters);
    }

    /**
     * Convert the object to an array
     *
     * @return array
     */
    public function toArray()
    {
        // Create an array instance of the object and filter all null values out of the list
        return array_filter(json_decode(json_encode($this), true), function ($field) {
            return $field !== null;
        });
    }
}