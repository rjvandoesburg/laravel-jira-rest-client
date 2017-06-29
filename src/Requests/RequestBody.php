<?php

namespace Atlassian\JiraRest\Requests;

use Atlassian\JiraRest\Requests\BaseRequest;
use Illuminate\Contracts\Support\Arrayable;

class RequestBody implements Arrayable
{

    /**
     * @var BaseRequest
     */
    protected $request;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $options;

    public function __construct(BaseRequest $request, $method, array $options = [])
    {
        $this->method = $method;
        $this->options = $options;
        $this->request = $request;
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

    /**
     * @return BaseRequest
     */
    public function getRequest()
    {
        return $this->request;
    }


}