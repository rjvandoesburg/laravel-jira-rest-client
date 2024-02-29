<?php

namespace Atlassian\JiraRest\Requests;

use Atlassian\JiraRest\Exceptions\JiraClientException;
use Atlassian\JiraRest\Exceptions\JiraNotFoundException;
use Atlassian\JiraRest\Exceptions\JiraUnauthorizedException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

abstract class AbstractRequest
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * A list of middleware to use for the current request
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * @var bool
     */
    protected $async = false;

    /**
     * BaseRequest constructor.
     */
    public function __construct()
    {
        // If the user has set default auth, include it
        if (($defaultAuth = config('atlassian.jira.default_auth')) !== null) {
            switch ($defaultAuth) {
                case 'basic':
                    $middleware = config('atlassian.jira.auth.basic.middleware', \Atlassian\JiraRest\Requests\Middleware\BasicAuthMiddleware::class);
                    $this->addMiddleware($middleware , 'auth');
                    break;
                case 'oauth':
                    $middleware = config('atlassian.jira.auth.oauth.middleware', \Atlassian\JiraRest\Requests\Middleware\OAuthMiddleware::class);
                    $this->addMiddleware($middleware , 'auth');
                    break;
                case 'basic_token':
                    $middleware = config('atlassian.jira.auth.basic_token.middleware', \Atlassian\JiraRest\Requests\Middleware\BasicApiTokenMiddleware::class);
                    $this->addMiddleware($middleware , 'auth');
                    break;
                case 'session':
                    // TODO: implement session default middleware
                    break;
            }
        }

        // TODO: Implement middleware groups etc like the kernel so the user can decide what middleware to add
        foreach (config('atlassian.jira.client_options') as $key => $value) {
            $this->addMiddleware($value, is_string($key) ? $key : null);
        }
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function createClient()
    {
        // Default Options
        $options = [
            'base_uri' => config('atlassian.jira.host'),
            'headers'  => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ] ,
        ];

        // Pipe the options through all middleware defined in the config
        app(\Illuminate\Pipeline\Pipeline::class)
            ->send($options)
            ->through($this->middleware)
            ->then(function ($options) {
                $this->client = new Client($options);
            });

        return $this->client;
    }

    /**
     * Get the request url
     *
     * @param string $resource
     *
     * @return \Psr\Http\Message\UriInterface
     */
    public function getRequestUrl($resource)
    {
        return Psr7\Utils::uriFor($this->getApi().'/'.$resource);
    }

    /**
     * Get the Api to call agains
     *
     * @return string
     */
    public function getApi()
    {
        return 'rest/api/2';
    }

    /**
     * Set the request mode to async
     *
     * @return $this
     */
    public function async()
    {
        $this->async = true;

        return $this;
    }

    /**
     * Execute the request and return the response as a stream
     *
     * @param string $method
     * @param string $resource
     * @param \Illuminate\Contracts\Support\Arrayable|array $parameters
     * @param bool $asQueryParameters Some non-GET requests require sending query parameters instead.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function execute($method, $resource, $parameters = [], $asQueryParameters = false  )
    {
        $method = strtoupper($method);
        $client = $this->createClient();

        try {
            if ($this->async) {
                return $client->requestAsync($method, $this->getRequestUrl($resource), $this->getOptions($method, $parameters, $asQueryParameters));
            }

            return $client->request($method, $this->getRequestUrl($resource), $this->getOptions($method, $parameters, $asQueryParameters));
        } catch (RequestException $exception) {
            $message = $this->getJiraException($exception);

            switch ($exception->getCode()) {
                case 401:
                    $message = __('You are not authenticated. Authentication required to perform this operation.');
                    throw new JiraUnauthorizedException($message, 401, $exception);
                case 404:
                    throw new JiraNotFoundException($message, 404, $exception);
                default:
                    throw new JiraClientException($message, $exception->getCode(), $exception);
            }
        }
    }

    /**
     * @param \GuzzleHttp\Exception\RequestException $exception
     *
     * @return string
     */
    protected function getJiraException(RequestException $exception)
    {
        $response = json_decode($exception->getResponse()->getBody(), true);
        $errors = Arr::get($response, 'errorMessages', []);
        if (empty($errors)) {
            foreach (Arr::get($response, 'errors', []) as $key => $value) {
                $errors[] = "$value [$key]";
            }
        }

        $message = implode("\n", $errors);

        return ! empty($message) ? $message : $exception->getMessage();
    }

    /**
     * @param string $method
     * @param \Illuminate\Contracts\Support\Arrayable|array $parameters
     * @param bool $asQueryParameters Some non-GET requests require sending query parameters instead.
     *
     * @return array
     */
    public function getOptions($method, $parameters = [], $asQueryParameters = false)
    {
        // Check if the parameters is an array or an instance of AbstractParameters
        if ($parameters instanceof Arrayable) {
            $parameters = $parameters->toArray();
        }

        // When dealing with a get request set the parameters as query
        if ($method === 'GET' || $asQueryParameters) {
            return [
                'query' => $parameters,
            ];
        }

        return [
            'json' => $parameters,
        ];
    }

    /**
     * @return string
     */
    protected function getJiraHost()
    {
        $host = config('atlassian.jira.host');
        $uri = Psr7\Utils::uriFor($host);

        return $uri->getHost();
    }

    /**
     * Because the user can enter either a raw array or an pre-defined class.
     * This method will validate the type of the parameters
     *
     * @param array|\Illuminate\Contracts\Support\Arrayable $parameters
     * @param string $class
     *
     * @return bool
     * @throws \TypeError
     */
    protected function validateParameters($parameters, $class)
    {
        // The parameters can be an array or empty
        if (is_array($parameters) || empty($parameters)) {
            return true;
        }

        // If we get here the parameters need to be an instance of the given class
        if ($parameters instanceof $class) {
            return true;
        }

        $wrongClass = get_class($parameters);
        $traceInformation = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
        $classInfo = array_pop($traceInformation);
        $caller = array_pop($traceInformation);

        throw new \TypeError("Parameters argument passed to {$classInfo['class']}::{$classInfo['function']}() must be of type {$class}, {$wrongClass} given, called in {$caller['file']} on line {$caller['line']}");
    }

    /**
     * Middleware to disable
     *
     * @param string $middleware
     */
    public function disableMiddleware($middleware)
    {
        Arr::forget($this->middleware, $middleware);
    }

    /**
     * @param string $middleware
     * @param null|string $name
     *
     * @return \Atlassian\JiraRest\Requests\AbstractRequest
     */
    public function addMiddleware($middleware, $name = null)
    {
        $this->middleware[$name ?? $middleware] = $middleware;

        return $this;
    }

}
