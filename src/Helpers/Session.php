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
     * @param $username
     * @param $password
     *
     * @return string
     */
    public function login($username, $password)
    {
        $response = $this->request->login([
            'username' => $username,
            'password' => $password
        ]);

        $response = json_decode($response->getBody(), true);

        $cookie = json_encode(Arr::get($response, 'session'));

        \Cache::put(\Config('atlassian.jira.session.name'), $cookie, \Config('atlassian.jira.session.duration'));

        return $cookie;
    }

    /**
     * @return bool
     */
    public function logout()
    {
        $this->request->logout();

        \Cache::forget(\Config('atlassian.jira.session.name'));

        return true;
    }
}