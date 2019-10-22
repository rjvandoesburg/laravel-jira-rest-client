<?php

namespace Atlassian\JiraRest\Requests\Auth;

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

    /**
     * @param $callbackUrl
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRequestToken($callbackUrl)
    {
        return $this->execute('post', "request-token?oauth_callback={$callbackUrl}");
    }

    /**
     * @param $verifier
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccessToken($verifier)
    {
        return $this->execute('post', "access-token?oauth_verifier={$verifier}");
    }

    /**
     * Creates a new session for a user in Jira.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-auth-1-session-post
     *
     * @param  array|\\Illuminate\\Contracts\\Support\\Arrayable |array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login($parameters)
    {
        $this->disableMiddleware('auth');

        return $this->execute('post', 'session', $parameters);
    }

}