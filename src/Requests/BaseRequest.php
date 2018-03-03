<?php

namespace Atlassian\JiraRest\Requests;

use Atlassian\JiraRest\Requests\Middleware\BasicAuthMiddleware;
use Atlassian\JiraRest\Requests\Middleware\FilterAcceptedOptions;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Atlassian\JiraRest\Exceptions\JiraClientException;
use Atlassian\JiraRest\Exceptions\JiraRequestException;
use Atlassian\JiraRest\Exceptions\JiraUnauthorizedException;

abstract class BaseRequest
{
    /**
     * @var Client
     */
    protected $client = null;

    protected $availableMethods = [];

    protected $options = [];

    protected $requestResponse = null;

    protected $skipAuthentication = true;

    protected $clientOptionsMiddleware = [
        BasicAuthMiddleware::class
    ];

    protected $requestMiddleware = [
        FilterAcceptedOptions::class
    ];

    protected $requestBody;

    /**
     * @return Client
     */
    public function createClient()
    {
        $handlerStack = new HandlerStack();
        $handlerStack->setHandler(\GuzzleHttp\choose_handler());
        $handlerStack->handle();

        // Default Options
        $options = [
            'base_uri' => config('atlassian.jira.host'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'handler' => $handlerStack
        ];

        // Pipe the options through all middleware
        (app(\Illuminate\Pipeline\Pipeline::class))
            ->send($options)
            ->through($this->clientOptionsMiddleware)
            ->then(function($options) {
                $this->client = new Client($options);
            });

        return $this->client;
    }

    /**
     * Get the request url
     *
     * @return \Psr\Http\Message\UriInterface
     */
    public function getRequestUrl()
    {
        return Psr7\uri_for($this->getApi() . '/' . $this->getResource());
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
     * Get the resource to call
     *
     * @return string
     */
    abstract public function getResource();

    /**
     * Get the available methods
     * The request will throw an exception if a method is called that is not available
     *
     * @return array
     */
    public function getAvailableMethods()
    {
        return [
            'get'
        ];
    }

    /**
     * @param $method
     * @param array $options
     *
     * @return \GuzzleHttp\Psr7\Stream
     */
    protected function handle($method, $options = [])
    {
        if (method_exists($this, 'beforeHandle')) {
            $this->beforeHandle($method, $options);
        }

        // Pipe the request through middleware before executing the request
        (app(\Illuminate\Pipeline\Pipeline::class))
            ->send(new RequestBody($this, $method, $options))
            ->through($this->requestMiddleware)
            ->then(function(RequestBody $requestBody) {
                $this->execute($requestBody);
            });

        if (method_exists($this, 'handleResponse')) {
            return $this->handleResponse($this->requestResponse->getBody(), $method);
        }

        return $this->requestResponse->getBody();
    }

    /**
     * Execute the request and return the response as a stream
     *
     * @param RequestBody $requestBody
     *
     * @throws JiraClientException
     */
    protected function execute(RequestBody $requestBody)
    {
        $client = $this->createClient();

        try {
            $this->requestResponse = $client->request(strtoupper($requestBody->getMethod()), $this->getRequestUrl(), $requestBody->toArray());
        } catch (ClientException $exception) {
            if ($exception->getCode() === 401) {
                throw new JiraUnauthorizedException('You are not authenticated. Authentication required to perform this operation.');
            }

            $message = $this->getErrorMessages($exception->getMessage());

            throw new JiraClientException($message, $exception->getCode(), $exception);
        }
    }

    /**
     * Try to parse the Json error from
     *
     * @param $message
     *
     * @return string
     */
    protected function getErrorMessages($message)
    {
        try {
            $pattern = '/(?\'json\'\{(?:[^{}]|(?R))*\})/x';
            preg_match_all($pattern, $message, $matches);
            $string = $matches['json'][0];

            $message = json_decode($string, true);

            // TODO: What to do on multiple errors
            return $message['errorMessages'][0];
        } catch (\Exception $exception) {

        }

        return $message;
    }

    public function __call($method, $arguments)
    {
        $method = strtolower($method);
        if (in_array($method, $this->getAvailableMethods())) {
            return $this->handle($method, ...$arguments);
        }

        throw new JiraRequestException('Method ' . $method . ' not allowed');
    }

    /**
     * Get all available options or options specific for a method
     *
     * @param null $method
     *
     * @return array
     */
    public function getAvailableOptions($method = null)
    {
        if ($method === null) {
            return $this->options;
        }

        if (array_key_exists($method, $this->options)) {
            return $this->options[$method];
        }

        return [];
    }

}