<?php

namespace Atlassian\JiraRest\Requests\Auth;

use Atlassian\JiraRest\Requests\Auth\Parameters\LoginParameters;
use Atlassian\JiraRest\Requests\AbstractRequest;

class OAuthRequest extends AbstractRequest
{
    /**
     * Get the Api to call agains
     *
     * @return string
     */
    public function getApi()
    {
        return 'plugins/servlet/oauth';
    }

    public function getRequestToken($callbackUrl)
    {
        return $this->execute('post', "request-token?oauth_callback={$callbackUrl}");
    }

    public function getAccessToken($verifier)
    {
        return $this->execute('post', "access-token?oauth_verifier={$verifier}");
    }

    public function requestAuthCredentials($token, $secret, $verifier)
    {

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
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function login($parameters)
    {
        $this->validateParameters($parameters, LoginParameters::class);
        $this->disableMiddleware('auth');

        return $this->execute('post', 'session', $parameters);
    }

}