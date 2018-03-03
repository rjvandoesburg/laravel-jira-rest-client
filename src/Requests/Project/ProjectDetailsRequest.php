<?php

namespace Atlassian\JiraRest\Requests\Project;

use Atlassian\JiraRest\Requests\AbstractRequest;
use Atlassian\JiraRest\Requests\Project\Parameters\AddActorParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\AssignedPermissionSchemeParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\DeleteActorParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\NotificationSchemaParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\SetActorsParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\VersionsPageinatedParameters;

class ProjectDetailsRequest extends AbstractRequest
{
    /**
     * Contains a full representation of a the specified project's components.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-components-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getComponents($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/components");
    }

    /**
     * Returns the keys of all properties for the project identified by the key or by the id.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-properties-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getPropertyKeys($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/properties");
    }

    /**
     * Returns the value of the property with a given key from the project identified by the key or by the id.
     * The user who retrieves the property is required to have permissions to read the project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-properties-propertyKey-get
     *
     * @param int|string $projectIdOrKey
     * @param string $propertyKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getProperty($projectIdOrKey, $propertyKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/properties/{$propertyKey}");
    }

    /**
     * Sets the value of the specified project’s property.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-properties-propertyKey-put
     *
     * @param int|string $projectIdOrKey
     * @param string $propertyKey
     *
     * @param $value
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function setProperty($projectIdOrKey, $propertyKey, $value)
    {
        return $this->execute('put', "project/{$projectIdOrKey}/properties/{$propertyKey}", $value);
    }

    /**
     * Removes the property from the project identified by the key or by the id.
     * The user removing the property is required to have permissions to administer the project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-properties-propertyKey-delete
     *
     * @param int|string $projectIdOrKey
     * @param string $propertyKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function deleteProperty($projectIdOrKey, $propertyKey)
    {
        return $this->execute('delete', "project/{$projectIdOrKey}/properties/{$propertyKey}");
    }

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

    /**
     * Returns a full representation of all issue types associated with a specified project, together with valid
     * statuses for each issue type.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-statuses-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getStatuses($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/statuses");
    }

    /**
     * Updates project type of a single project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-type-newProjectTypeKey-put
     *
     * @param int|string $projectIdOrKey
     * @param string $newProjectTypeKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function updateProjectType($projectIdOrKey, $newProjectTypeKey)
    {
        return $this->execute('put', "project/{$projectIdOrKey}/type/{$newProjectTypeKey}");
    }

    /**
     * Returns a paginated representation of all versions existing in a single project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-version-get
     *
     * @param int|string $projectIdOrKey
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\VersionsPageinatedParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function getVersionsPaginated($projectIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, VersionsPageinatedParameters::class);

        return $this->execute('get', "project/{$projectIdOrKey}/version", $parameters);
    }

    /**
     * Returns a full representation of all versions existing in a single project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-versions-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getVersions($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/versions");
    }

    /**
     * Returns the issue security scheme for project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectKeyOrId-issuesecuritylevelscheme-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getIssueSecurityScheme($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/issuesecuritylevelscheme");
    }

    /**
     * Gets a notification scheme associated with the project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectKeyOrId-notificationscheme-get
     *
     * @param int|string $projectIdOrKey
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\NotificationSchemaParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function getNotificationScheme($projectIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, NotificationSchemaParameters::class);

        return $this->execute('get', "project/{$projectIdOrKey}/notificationscheme");
    }

    /**
     * Gets a permission scheme assigned with a project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectKeyOrId-permissionscheme-get
     *
     * @param int|string $projectIdOrKey
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\AssignedPermissionSchemeParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function getAssignedPermissionScheme($projectIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, AssignedPermissionSchemeParameters::class);

        return $this->execute('get', "project/{$projectIdOrKey}/permissionscheme");
    }

    /**
     * Assigns a permission scheme with a project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectKeyOrId-permissionscheme-put
     *
     * @param int|string $projectIdOrKey
     * @param int $newPermissionScheme
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function assignPermissionScheme($projectIdOrKey, $newPermissionScheme)
    {
        return $this->execute('put', "project/{$projectIdOrKey}/permissionscheme", $newPermissionScheme);
    }

    /**
     * Returns all security levels for the project that the current logged in user has access to.
     * If the user does not have the Set Issue Security permission, the list will be empty.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectKeyOrId-securitylevel-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getSecurityLevels($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/securitylevel");
    }

}