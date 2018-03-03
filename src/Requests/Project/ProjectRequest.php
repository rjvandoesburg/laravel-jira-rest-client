<?php

namespace Atlassian\JiraRest\Requests\Project;

use Atlassian\JiraRest\Requests\AbstractRequest;
use Atlassian\JiraRest\Requests\Project\Parameters\CreateParameters;
use Atlassian\JiraRest\Requests\Project\Parameters\GetAllParameters;

class ProjectRequest extends AbstractRequest
{
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
     * @throws \TypeError
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
     * @throws \TypeError
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
     * @throws \TypeError
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
     * @throws \TypeError
     */
    public function getAccessibleProjectType($projectTypeKey)
    {
        return $this->execute('get', "project/type/{$projectTypeKey}/accessible");
    }

}