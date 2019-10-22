<?php

namespace Atlassian\JiraRest\Requests\Project\Traits;

trait RoleRequests
{
    /**
     * Returns all roles in the given project Id or key, with links to full details on each role.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-role-get
     *
     * @param  int|string  $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRoles($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/role");
    }

    /**
     * Returns the details for a given project role in a project together with project role actors.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-role-id-get
     *
     * @param  int|string  $projectIdOrKey
     * @param  int  $roleId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRole($projectIdOrKey, $roleId)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/role/{$roleId}");
    }

    /**
     * Returns all roles in the given project Id or key.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-roledetails-get
     *
     * @param  int|string  $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRoleDetails($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/roledetails");
    }

    /**
     * Adds an actor (user or group) to a project role.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-post
     *
     * @param  int|string  $projectIdOrKey
     * @param  int  $roleId
     * @param  \Atlassian\JiraRest\Requests\Project\Parameters\AddActorParameters|array  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addActor($projectIdOrKey, $roleId, $parameters = [])
    {
        return $this->execute('post', "project/{$projectIdOrKey}/role/{$roleId}", $parameters);
    }

    /**
     * Updates a project role to include the specified actors (users or groups).
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-put
     *
     * @param  int|string  $projectIdOrKey
     * @param  int  $roleId
     * @param  \Atlassian\JiraRest\Requests\Project\Parameters\SetActorsParameters|array  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setActors($projectIdOrKey, $roleId, $parameters = [])
    {
        return $this->execute('put', "project/{$projectIdOrKey}/role/{$roleId}", $parameters);
    }

    /**
     * Deletes actors (users or groups) from a project role.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-delete
     *
     * @param  int|string  $projectIdOrKey
     * @param  int  $roleId
     * @param  \Atlassian\JiraRest\Requests\Project\Parameters\DeleteActorParameters|array  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteActor($projectIdOrKey, $roleId, $parameters = [])
    {
        return $this->execute('delete', "project/{$projectIdOrKey}/role/{$roleId}", $parameters, true);
    }
}