<?php

namespace Atlassian\JiraRest\Requests\Project\Traits;

trait ComponentsRequests
{
    /**
     * Returns a paginated representation of all components existing in a single project.
     * See the Get project components resource if you want to get a full list of versions without pagination.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-component-get
     *
     * @param  int|string  $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getComponentsPaginated($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/component");
    }

    /**
     * Contains a full representation of a the specified project's components.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-components-get
     *
     * @param  int|string  $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getComponents($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/components");
    }
}
