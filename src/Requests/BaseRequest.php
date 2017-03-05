<?php

namespace Rjvandoesburg\Jira\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Rjvandoesburg\Jira\Exceptions\JiraClientException;
use Rjvandoesburg\Jira\Exceptions\JiraRequestException;
use Rjvandoesburg\Jira\Exceptions\JiraUnauthorizedException;
use Rjvandoesburg\Jira\Requests\Auth\Session;

abstract class BaseRequest
{
    /**
     * @var Client
     */
    protected $client = null;

    protected $availableMethods = [];

    protected $options = [];

    protected $requestResponse = null;

    protected $skipAuthentication = false;

    /**
     * @return Client
     */
    public function getClient()
    {
        if ($this->client === null) {
            $options = [
                'base_uri' => config('jira.host'),
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ];

            // TODO: OAUTH
            if (! $this->skipAuthentication) {
                switch (config('jira.default_auth')) {
                    case 'basic':
                        $options['auth'] = [
                            config('jira.auth.basic.username'),
                            config('jira.auth.basic.password')
                        ];
                        break;
                    case 'cookie':
                        // Perform new session request

                        if ($cookie = \Cache::get('jira_cookie', false)) {
                            $cookie = json_decode($cookie);

                            $options['headers']['cookie'] = $cookie->name .'='.$cookie->value;
                        } else {

                            $sessionRequest = new Session();
                            $cookie = $sessionRequest->post([
                                'username' => config('jira.auth.basic.username'),
                                'password' => config('jira.auth.basic.password')
                            ]);

                            $cookie = json_decode($cookie);

                            $options['headers']['cookie'] = $cookie->name .'='.$cookie->value;
                        }
                        break;
                }
            }

            if (method_exists($this, 'beforeClientCreate')) {
                $options = $this->beforeClientCreate($options);
            }

            $this->client = new Client($options);

            if (method_exists($this, 'afterClientCreate')) {
                $this->afterClientCreate();
            }
        }

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

    protected function handle($method, $options = [])
    {
        if (method_exists($this, 'beforeHandle')) {
            $this->beforeHandle($method, $options);
        }

        // Reject all options that are not set in $this->options


        $options = $this->FilterAcceptedOptions($method, $options);

        $this->execute($method, $options);

        if (method_exists($this, 'handleResponse')) {
            return $this->handleResponse($this->requestResponse->getBody()->getContents(), $method);
        }

        return json_decode($this->requestResponse->getBody()->getContents());
    }

    protected function execute($method, $options)
    {
        $client = $this->getClient();
        try {
            if ($method === 'get') {
                $options = [
                    'query' => $options
                ];
            } else {
                $options = [
                    'json' => $options
                ];
            }

            $this->requestResponse = $client->request(strtoupper($method), $this->getRequestUrl(), $options);
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
     * @param $method
     * @param $options
     *
     * @return array
     */
    protected function FilterAcceptedOptions($method, $options)
    {
        return collect($options)->mapWithKeys(function ($value, $option) {
            // Just in case we want to use lowe case :)
            return [camel_case($option) => $value];
        })->filter(function ($value, $option) use ($method) {
            if (! isset($this->options[$method])) {
                return false;
            }

            return in_array($option, $this->options[$method]);
        })->toArray();
    }

    /**
     * @return string
     */
    protected function getJiraHost()
    {
        $host = config('jira.host');
        $uri  = Psr7\uri_for($host);

        return $uri->getHost();
    }

}