<?php

namespace Atlassian\JiraRest\Requests\Project;

use Atlassian\JiraRest\Requests\AbstractRequest;

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
     * @throws \TypeError
     */
    public function getComponents($projectIdOrKey)
    {
        // TODO: Implement getComponents method
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
     * @throws \TypeError
     */
    public function getPropertyKeys($projectIdOrKey)
    {
        // TODO: Implement getPropertyKeys method
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
     * @throws \TypeError
     */
    public function getProperty($projectIdOrKey, $propertyKey)
    {
        // TODO: Implement getProperty method
    }

    /**
     * Sets the value of the specified project’s property.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-properties-propertyKey-put
     *
     * @param int|string $projectIdOrKey
     * @param string $propertyKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function setProperty($projectIdOrKey, $propertyKey)
    {
        // TODO: Implement setProperty method
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
     * @throws \TypeError
     */
    public function deleteProperty($projectIdOrKey, $propertyKey)
    {
        // TODO: Implement deleteProperty method
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
     * @throws \TypeError
     */
    public function getRoles($projectIdOrKey)
    {
        // TODO: Implement getRoles method
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
     * @throws \TypeError
     */
    public function getRole($projectIdOrKey, $roleId)
    {
        // TODO: Implement getRole method
    }

    /**
     * Adds an actor (user or group) to a project role.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-post
     *
     * @param int|string $projectIdOrKey
     * @param int $roleId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function addActor($projectIdOrKey, $roleId)
    {
        // TODO: Implement addActor method
    }

    /**
     * Updates a project role to include the specified actors (users or groups).
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-put
     *
     * @param int|string $projectIdOrKey
     * @param int $roleId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function setActors($projectIdOrKey, $roleId)
    {
        // TODO: Implement setActors method
    }

    /**
     * Deletes actors (users or groups) from a project role.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-delete
     *
     * @param int|string $projectIdOrKey
     * @param int $roleId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function deleteActor($projectIdOrKey, $roleId)
    {
        // TODO: Implement deleteActor method
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
     * @throws \TypeError
     */
    public function getRoleDetails($projectIdOrKey)
    {
        // TODO: Implement getRoleDetails method
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
     * @throws \TypeError
     */
    public function getStatuses($projectIdOrKey)
    {
        // TODO: Implement getStatuses method
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
     * @throws \TypeError
     */
    public function updateProjectType($projectIdOrKey, $newProjectTypeKey)
    {
        // TODO: Implement updateProjectType method
    }

    /**
     * Returns a paginated representation of all versions existing in a single project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-version-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function getVersionsPaginated($projectIdOrKey)
    {
        // TODO: Implement getVersionsPaginated method
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
     * @throws \TypeError
     */
    public function getVersions($projectIdOrKey)
    {
        // TODO: Implement getVersions method
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
     * @throws \TypeError
     */
    public function getIssueSecurityScheme($projectIdOrKey)
    {
        // TODO: Implement getIssueSecurityScheme method
    }

    /**
     * Gets a notification scheme associated with the project.
     * Follow the documentation of /notificationscheme/{id} resource for all details about returned value.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectKeyOrId-notificationscheme-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function getNotificationScheme($projectIdOrKey)
    {
        // TODO: Implement getNotificationScheme method
    }

    /**
     * Gets a permission scheme assigned with a project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectKeyOrId-permissionscheme-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function getAssignedPermissionScheme($projectIdOrKey)
    {
        // TODO: Implement getAssignedPermissionScheme method
    }

    /**
     * Assigns a permission scheme with a project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectKeyOrId-permissionscheme-put
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function assignPermissionScheme($projectIdOrKey)
    {
        // TODO: Implement assignPermissionScheme method
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
     * @throws \TypeError
     */
    public function getSecurityLevels($projectIdOrKey)
    {
        // TODO: Implement getSecurityLevels method
    }

}