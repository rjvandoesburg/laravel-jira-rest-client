<?php

namespace Atlassian\JiraRest\Requests\Project;

use Atlassian\JiraRest\Requests\AbstractRequest;
use Atlassian\JiraRest\Requests\Project\Parameters\AssignedPermissionSchemeParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\CreateParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\GetAllParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\NotificationSchemaParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\VersionsPageinatedParameters;
use Atlassian\JiraRest\Requests\Project\Traits\AvatarRequests;
use Atlassian\JiraRest\Requests\Project\Traits\PropertiesRequests;
use Atlassian\JiraRest\Requests\Project\Traits\RoleRequests;

class ProjectRequest extends AbstractRequest
{
    use AvatarRequests;
    use PropertiesRequests;
    use RoleRequests;

    /**
     * Returns all projects visible for the currently logged in user, ie. all the projects the user has either ‘Browse projects’ or ‘Administer projects’ permission.
     * If no user is logged in, it returns all projects that are visible for anonymous users.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-get
     *
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\GetAllParameters|array $parameters
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function all($parameters = [])
    {
        $this->validateParameters($parameters, GetAllParameters::class);

        return $this->execute('get', 'project', $parameters);
    }

    /**
     * Creates a new project from a JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-post
     *
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\CreateParameters|array $parameters
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function create($parameters = [])
    {
        $this->validateParameters($parameters, CreateParameters::class);

        return $this->execute('post', 'project', $parameters);
    }

    /**
     * Returns a full representation of a single project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-get
     *
     * @param int|string $projectIdOrKey
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\GetParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function get($projectIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, GetAllParameters::class);

        return $this->execute('get', "project/{$projectIdOrKey}", $parameters);
    }

    /**
     * Updates the details of an existing project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-put
     *
     * @param int|string $projectIdOrKey
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\UpdateParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function update($projectIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, GetAllParameters::class);

        return $this->execute('put', "project/{$projectIdOrKey}", $parameters);
    }

    /**
     * Deletes an existing project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-delete
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function delete($projectIdOrKey)
    {
        return $this->execute('delete', "project/{$projectIdOrKey}");
    }

    /**
     * Returns all the project types defined on the Jira instance, not taking into account whether the license to use
     * those project types is valid or not.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-type-get
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getAllProjectTypes()
    {
        return $this->execute('get', 'project/type');
    }

    /**
     * Returns the project type with the given key.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-type-projectTypeKey-get
     *
     * @param string $projectTypeKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getProjectType($projectTypeKey)
    {
        return $this->execute('get', "project/type/{$projectTypeKey}");
    }

    /**
     * Returns the project type with the given key.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-type-projectTypeKey-accessible-get
     *
     * @param string $projectTypeKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getAccessibleProjectType($projectTypeKey)
    {
        return $this->execute('get', "project/type/{$projectTypeKey}/accessible");
    }
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