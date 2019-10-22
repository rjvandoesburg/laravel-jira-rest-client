<?php

namespace Atlassian\JiraRest\Requests\Project;

use Atlassian\JiraRest\Requests\AbstractRequest;

class ProjectRequest extends AbstractRequest
{
    use Traits\AvatarRequests;
    use Traits\ComponentsRequests;
    use Traits\PermissionsSchemesRequests;
    use Traits\PropertiesRequests;
    use Traits\RoleRequests;
    use Traits\TypesRequests;
    use Traits\VersionsRequests;

    /**
     * Returns all projects visible for the currently logged in user, ie. all the projects the user has either ‘Browse
     * projects’ or ‘Administer projects’ permission.
     * If no user is logged in, it returns all projects that are visible for anonymous users.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-get
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @deprecated Use search instead
     */
    public function all($parameters = [])
    {
        return $this->execute('get', 'project', $parameters);
    }

    /**
     * Creates a new project from a JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-post
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($parameters = [])
    {
        return $this->execute('post', 'project', $parameters);
    }

    /**
     * Returns all projects visible for the currently logged in user, ie. all the projects the user has either ‘Browse
     * projects’ or ‘Administer projects’ permission. If no user is logged in, it returns all projects that are visible
     * for anonymous users.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-search-get
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search($parameters = [])
    {
        return $this->execute('get', 'project/search', $parameters);
    }

    /**
     * Returns a full representation of a single project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-get
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
    public function get($projectIdOrKey, $parameters = [])
    {
        return $this->execute('get', "project/{$projectIdOrKey}", $parameters);
    }

    /**
     * Updates the details of an existing project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-put
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
    public function update($projectIdOrKey, $parameters = [])
    {
        return $this->execute('put', "project/{$projectIdOrKey}", $parameters);
    }

    /**
     * Deletes an existing project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-delete
     *
     * @param  int|string  $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($projectIdOrKey)
    {
        return $this->execute('delete', "project/{$projectIdOrKey}");
    }

    /**
     * Returns a full representation of all issue types associated with a specified project, together with valid
     * statuses for each issue type.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-statuses-get
     *
     * @param  int|string  $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getStatuses($projectIdOrKey)
    {
        return $this->execute('get', "project/{$projectIdOrKey}/statuses");
    }

    /**
     * Updates project type of a single project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectIdOrKey-type-newProjectTypeKey-put
     *
     * @param  int|string  $projectIdOrKey
     * @param  string  $newProjectTypeKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @deprecated Deprecated, this feature is no longer supported and no alternatives are available.
     */
    public function updateProjectType($projectIdOrKey, $newProjectTypeKey)
    {
        return $this->execute('put', "project/{$projectIdOrKey}/type/{$newProjectTypeKey}");
    }

    /**
     * Gets a notification scheme associated with the project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-project-projectKeyOrId-notificationscheme-get
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
    public function getNotificationScheme($projectIdOrKey, $parameters = [])
    {
        return $this->execute('get', "project/{$projectIdOrKey}/notificationscheme", $parameters);
    }
}