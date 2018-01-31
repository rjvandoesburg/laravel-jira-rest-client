<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\Auth\SessionRequest;
use Illuminate\Support\Arr;

class Session
{
    /**
     * @var \Atlassian\JiraRest\Requests\Auth\SessionRequest
     */
    protected $request;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->request = app(SessionRequest::class);
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function get()
    {
        return $this->request->get();
    }

    /**
     * @param $parameters
     *
     * @return string
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \TypeError
     */
    public function login($parameters)
    {
        $response = $this->request->login($parameters);
        $response = json_decode((string) $response->getBody(), true);

        $cookie = json_encode(Arr::get($response, 'session'));

        \Cache::put(\Config('atlassian.jira.session.name'), $cookie, \Config('atlassian.jira.session.duration'));

        return $cookie;
    }

    /**
     * @return bool
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \TypeError
     */
    public function logout()
    {
        $this->request->logout();

        \Cache::forget(\Config('atlassian.jira.session.name'));

        return true;
    }
}