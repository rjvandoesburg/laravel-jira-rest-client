<?php

namespace Atlassian\JiraRest\Requests\Project\Traits;

trait VersionsRequests
{
    /**
     * Returns a paginated representation of all versions existing in a single project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-version-get
     *
     * @param  int|string  $projectIdOrKey
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getVersionsPaginated($projectIdOrKey, $parameters = [])
    {
        return $this->execute('get', "project/{$projectIdOrKey}/version", $parameters);
    }

    /**
     * Returns a full representation of all versions existing in a single project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-versions-get
     *
     * @param  int|string  $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getVersions($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/versions");
    }
}
