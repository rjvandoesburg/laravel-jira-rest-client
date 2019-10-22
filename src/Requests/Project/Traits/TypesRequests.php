<?php

namespace Atlassian\JiraRest\Requests\Project\Traits;

trait TypesRequests
{
    /**
     * Returns all the project types defined on the Jira instance, not taking into account whether the license to use
     * those project types is valid or not.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-type-get
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllProjectTypes()
    {
        return $this->execute('get', 'project/type');
    }

    /**
     * Returns the project type with the given key.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-type-projectTypeKey-get
     *
     * @param  string  $projectTypeKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getProjectType($projectTypeKey)
    {
        return $this->execute('get', "project/type/{$projectTypeKey}");
    }

    /**
     * Returns the project type with the given key.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-type-projectTypeKey-accessible-get
     *
     * @param  string  $projectTypeKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccessibleProjectType($projectTypeKey)
    {
        return $this->execute('get', "project/type/{$projectTypeKey}/accessible");
    }
}
