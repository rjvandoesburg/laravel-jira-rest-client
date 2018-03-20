<?php

namespace Atlassian\JiraRest\Requests\Project\Traits;

trait PropertiesRequests
{

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
}