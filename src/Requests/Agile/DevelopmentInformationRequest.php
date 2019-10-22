<?php

namespace Atlassian\JiraRest\Requests\Agile;

class DevelopmentInformationRequest extends AbstractRequest
{
    /**
     * Stores development information provided in the request to make it available when viewing issues in JIRA.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-devinfo-0-10-bulk-post
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function storeInformation(array $parameters)
    {
        return $this->execute('post', 'bulk', $parameters);
    }

    /**
     * For the specified repository ID, retrieves the repository and the most recent 400 development information
     * entities. The result will be what is currently stored, ignoring any pending updates or deletes.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-devinfo-0-10-repository-repositoryId-get
     *
     * @param  string  $repositoryId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRepository($repositoryId)
    {
        return $this->execute('get', "repository/{$repositoryId}");
    }

    /**
     * Deletes the repository data stored by the given ID and all related development information entities.
     * Deletion is performed asynchronously.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-devinfo-0-10-repository-repositoryId-delete
     *
     * @param  string  $repositoryId
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteRepository($repositoryId, array $parameters)
    {
        return $this->execute('delete', "repository/{$repositoryId}", $parameters);
    }

    /**
     * Deletes development information entities which have all the provided properties.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-devinfo-0-10-bulkByProperties-delete
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteByProperties(array $parameters)
    {
        return $this->execute('delete', 'bulkByProperties', $parameters);
    }

    /**
     * Checks if development information which have all the provided properties exists.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-devinfo-0-10-existsByProperties-get
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function existsByProperties(array $parameters)
    {
        return $this->execute('get', 'existsByProperties', $parameters);
    }

    /**
     * Deletes particular development information entity. Deletion is performed asynchronously.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-devinfo-0-10-repository-repositoryId-entityType-entityId-delete
     *
     * @param  string  $repositoryId
     * @param  string  $entityType
     * @param  string  $entityId
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteEntity($repositoryId, $entityType, $entityId, array $parameters)
    {
        return $this->execute('delete', "repository/{$repositoryId}/{$entityType}/{$entityId}", $parameters);
    }

    /**
     * Get the Api to call agains
     *
     * @return string
     */
    public function getApi()
    {
        return 'rest/devinfo/0.10';
    }

}
