<?php

namespace Atlassian\JiraRest;

use Illuminate\Contracts\Support\Arrayable;

class RequestBody implements Arrayable
{
    protected $method;

    protected $options;

    public function __construct($method, $options)
    {
        $this->method = $method;
        $this->options = $options;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $key = $this->method === 'get' ? 'query' : 'json';
        return [
            $key => $this->options
        ];
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }


}