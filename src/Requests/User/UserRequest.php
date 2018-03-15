<?php

namespace Atlassian\JiraRest\Requests\User;

use Atlassian\JiraRest\Requests\AbstractRequest;
use Atlassian\JiraRest\Requests\User\Parameters\GetParameters;
use Atlassian\JiraRest\Requests\User\Parameters\SearchParameters;

class UserRequest extends AbstractRequest
{
    /**
     * Returns a user.
     * This resource cannot be accessed anonymously.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-user-get
     *
     * @param \Atlassian\JiraRest\Requests\User\Parameters\GetParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function get($parameters)
    {
        $this->validateParameters($parameters, GetParameters::class);

        return $this->execute('get', 'user', $parameters);
    }

    /**
     * Returns a list of users that match the search string and/or property.
     * This resource cannot be accessed anonymously.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-user-search-get
     *
     * @param \Atlassian\JiraRest\Requests\User\Parameters\GetParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function search($parameters)
    {
        $this->validateParameters($parameters, SearchParameters::class);

        return $this->execute('get', 'user/search', $parameters);
    }


}