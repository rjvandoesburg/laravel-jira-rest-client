<?php

namespace Atlassian\JiraRest\Requests\Project\Traits;

trait PermissionsSchemesRequests
{
    /**
     * Returns the issue security scheme for project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectKeyOrId-issuesecuritylevelscheme-get
     *
     * @param  int|string  $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getIssueSecurityScheme($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/issuesecuritylevelscheme");
    }

    /**
     * Gets a permission scheme assigned with a project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectKeyOrId-permissionscheme-get
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
    public function getAssignedPermissionScheme($projectIdOrKey, $parameters = [])
    {
        return $this->execute('get', "project/{$projectIdOrKey}/permissionscheme", $parameters);
    }

    /**
     * Assigns a permission scheme with a project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectKeyOrId-permissionscheme-put
     *
     * @param  int|string  $projectIdOrKey
     * @param  int  $newPermissionScheme
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function assignPermissionScheme($projectIdOrKey, $newPermissionScheme)
    {
        return $this->execute('put', "project/{$projectIdOrKey}/permissionscheme", $newPermissionScheme);
    }

    /**
     * Returns all security levels for the project that the current logged in user has access to.
     * If the user does not have the Set Issue Security permission, the list will be empty.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectKeyOrId-securitylevel-get
     *
     * @param  int|string  $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSecurityLevels($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/securitylevel");
    }
}
