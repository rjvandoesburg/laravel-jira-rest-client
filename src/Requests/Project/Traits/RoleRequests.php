<?php

namespace Atlassian\JiraRest\Requests\Project\Traits;

use Atlassian\JiraRest\Requests\Project\Parameters\AddActorParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\DeleteActorParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\SetActorsParameters;

trait RoleRequests
{

    /**
     * Returns all roles in the given project Id or key, with links to full details on each role.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getRoles($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/role");
    }

    /**
     * Returns the details for a given project role in a project together with project role actors.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-get
     *
     * @param int|string $projectIdOrKey
     * @param int $roleId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getRole($projectIdOrKey, $roleId)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/role/{$roleId}");
    }

    /**
     * Adds an actor (user or group) to a project role.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-post
     *
     * @param int|string $projectIdOrKey
     * @param int $roleId
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\AddActorParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function addActor($projectIdOrKey, $roleId, $parameters = [])
    {
        $this->validateParameters($parameters, AddActorParameters::class);

        return $this->execute('post', "project/{$projectIdOrKey}/role/{$roleId}", $parameters);
    }

    /**
     * Updates a project role to include the specified actors (users or groups).
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-put
     *
     * @param int|string $projectIdOrKey
     * @param int $roleId
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\SetActorsParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function setActors($projectIdOrKey, $roleId, $parameters = [])
    {
        $this->validateParameters($parameters, SetActorsParameters::class);

        return $this->execute('put', "project/{$projectIdOrKey}/role/{$roleId}", $parameters);
    }

    /**
     * Deletes actors (users or groups) from a project role.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-delete
     *
     * @param int|string $projectIdOrKey
     * @param int $roleId
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\DeleteActorParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function deleteActor($projectIdOrKey, $roleId, $parameters = [])
    {
        $this->validateParameters($parameters, DeleteActorParameters::class);

        return $this->execute('delete', "project/{$projectIdOrKey}/role/{$roleId}", $parameters, true);
    }

    /**
     * Returns all roles in the given project Id or key.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-roledetails-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getRoleDetails($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/roledetails");
    }
}