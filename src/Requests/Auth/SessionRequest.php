<?php

namespace Atlassian\JiraRest\Requests\Auth;

use Atlassian\JiraRest\Requests\Auth\Parameters\LoginParameters;
use Atlassian\JiraRest\Requests\AbstractRequest;

class SessionRequest extends AbstractRequest
{
    /**
     * Api resource to hit
     *
     * @var string
     */
    protected $resource = 'session';

    /**
     * Get the Api to call agains
     *
     * @return string
     */
    public function getApi()
    {
        return 'rest/auth/1';
    }

    /**
     * Returns information about the currently authenticated user.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-auth-1-session-get
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \TypeError
     */
    public function get()
    {
        return $this->execute('get');
    }

    /**
     * Creates a new session for a user in Jira.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-auth-1-session-post
     *
     * @param \Atlassian\JiraRest\Requests\Auth\Parameters\LoginParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \TypeError
     */
    public function login($parameters)
    {
        $this->validateParameters($parameters, LoginParameters::class);
        $this->disableMiddleware('auth');

        return $this->execute('post', $parameters);
    }

    /**
     * Logs the current user out of Jira, destroying the existing session, if any.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-auth-1-session-delete
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \TypeError
     */
    public function logout()
    {
        return $this->execute('delete');
    }
}