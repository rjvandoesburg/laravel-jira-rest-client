<?php

namespace Atlassian\JiraRest;

use GuzzleHttp\HandlerStack as BaseStack;
use GuzzleHttp\Middleware;
use Illuminate\Pipeline\Pipeline;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HandlerStack extends BaseStack
{
    protected $middleware = [];

    public function __construct(callable $handler = null)
    {
        parent::__construct($handler);
    }

    public function handle()
    {
        $this->push(Middleware::mapRequest(function (RequestInterface $response) {
            (app(\Illuminate\Pipeline\Pipeline::class))
                ->send($response)
                ->through($this->middleware);
        }));
//        $this->push(Middleware::mapResponse(function (ResponseInterface $response) {
//            dd($response);
//        }));
    }

    /**
     * Parse a middleware string to get the name and parameters.
     *
     * @param  string  $middleware
     * @return array
     */
    protected function parseMiddleware($middleware)
    {
        list($name, $parameters) = array_pad(explode(':', $middleware, 2), 2, []);

        if (is_string($parameters)) {
            $parameters = explode(',', $parameters);
        }

        return [$name, $parameters];
    }

    /**
     * Determine if the kernel has a given middleware.
     *
     * @param  string  $middleware
     * @return bool
     */
    public function hasMiddleware($middleware)
    {
        return in_array($middleware, $this->middleware);
    }

    /**
     * Add a new middleware to beginning of the stack if it does not already exist.
     *
     * @param  string  $middleware
     * @return $this
     */
    public function prependMiddleware($middleware)
    {
        if (array_search($middleware, $this->middleware) === false) {
            array_unshift($this->middleware, $middleware);
        }

        return $this;
    }

    /**
     * Add a new middleware to end of the stack if it does not already exist.
     *
     * @param  string  $middleware
     * @return $this
     */
    public function pushMiddleware($middleware)
    {
        if (array_search($middleware, $this->middleware) === false) {
            $this->middleware[] = $middleware;
        }

        return $this;
    }
}