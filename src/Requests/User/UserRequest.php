<?php

namespace Atlassian\JiraRest\Requests\User;

use Atlassian\JiraRest\Requests\AbstractRequest;

class UserRequest extends AbstractRequest
{
    /**
     * Returns a user.
     * This resource cannot be accessed anonymously.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-user-get
     *
     * @param  array|\\Illuminate\\Contracts\\Support\\Arrayable   $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($parameters)
    {
        return $this->execute('get', 'user', $parameters);
    }

    /**
     * Returns a list of users that match the search string and/or property.
     * This resource cannot be accessed anonymously.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-users-search-get
     *
     * @param  array|\\Illuminate\\Contracts\\Support\\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search($parameters)
    {
        return $this->execute('get', 'user/search', $parameters);
    }


}