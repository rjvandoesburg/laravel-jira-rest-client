<?php

namespace Atlassian\JiraRest\Requests;

use Atlassian\JiraRest\Requests\Middleware\TestMiddleware;
use GuzzleHttp\Middleware;
use Illuminate\Pipeline\Pipeline;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HandlerStack extends \GuzzleHttp\HandlerStack
{
    /**
     * An array to alter the request
     * @see http://docs.guzzlephp.org/en/latest/handlers-and-middleware.html#creating-a-handler
     *
     * @var array
     */
    protected $requestMiddleware = [

    ];

    /**
     * This array can be used to alter the response before giving it back to the original request
     * For example, one could use this to cache data
     *
     * @var array
     */
    protected $responseMiddleware = [

    ];

    public function __construct(callable $handler = null)
    {
        parent::__construct($handler);
    }

    public function handle()
    {
        $this->push(Middleware::mapRequest(function (RequestInterface $request) {
            // Return the request
            return (app(\Illuminate\Pipeline\Pipeline::class))
                ->send($request)
                ->through($this->requestMiddleware)
                ->then(function(RequestInterface $request) {
                    return $request;
                });
        }));

        $this->push(Middleware::mapResponse(function (ResponseInterface $response) {
            // Return the response
            return (app(\Illuminate\Pipeline\Pipeline::class))
                ->send($response)
                ->through($this->responseMiddleware)
                ->then(function(ResponseInterface $response) {
                    return $response;
                });
        }));
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
        return in_array($middleware, $this->requestMiddleware);
    }

    /**
     * Add a new middleware to beginning of the stack if it does not already exist.
     *
     * @param  string  $middleware
     * @return $this
     */
    public function prependMiddleware($middleware)
    {
        if (array_search($middleware, $this->requestMiddleware) === false) {
            array_unshift($this->requestMiddleware, $middleware);
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
        if (array_search($middleware, $this->requestMiddleware) === false) {
            $this->requestMiddleware[] = $middleware;
        }

        return $this;
    }
}