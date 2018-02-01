<?php

namespace Atlassian\JiraRest\Requests\Project;

use Atlassian\JiraRest\Requests\AbstractRequest;

class ProjectRequest extends AbstractRequest
{
    /**
     * Returns all projects visible for the currently logged in user, ie. all the projects the user has either ‘Browse projects’ or ‘Administer projects’ permission.
     * If no user is logged in, it returns all projects that are visible for anonymous users.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-get
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function all()
    {
        // TODO: Implement all method
    }

    /**
     * Creates a new project from a JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-post
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function create()
    {
        // TODO: Implement create method
    }

    /**
     * Returns a full representation of a single project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function get($projectIdOrKey)
    {
        // TODO: Implement get method
    }

    /**
     * Updates the details of an existing project.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-put
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function update($projectIdOrKey)
    {
        // TODO: Implement update method
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
        // TODO: Implement delete method
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
        // TODO: Implement getAllProjectTypes method
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
        // TODO: Implement getProjectType method
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
        // TODO: Implement getAccessibleProjectType method
    }

}