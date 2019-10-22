<?php

namespace Atlassian\JiraRest\Requests\Agile;

class BuildsRequest extends AbstractRequest
{
    /**
     * Update / insert builds data.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-builds-0-1-bulk-post
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submit(array $parameters)
    {
        return $this->execute('post', 'bulk', $parameters);
    }

    /**
     * Bulk delete all builds data that match the given request.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-builds-0-1-bulkByProperties-delete
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteByProperty(array $parameters)
    {
        return $this->execute('delete', 'bulkByProperties', $parameters, true);
    }

    /**
     * Retrieve the currently stored build data for the given pipelineId and buildNumber combination.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-builds-0-1-pipelines-pipelineId-builds-buildNumber-get
     *
     * @param  string  $pipelineId
     * @param  int  $buildNumber
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getById($pipelineId, $buildNumber)
    {
        return $this->execute('get', "pipelines/{$pipelineId}/builds/{$buildNumber}");
    }

    /**
     * Delete the build data currently stored for the given pipelineId and buildNumber combination.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-builds-0-1-pipelines-pipelineId-builds-buildNumber-delete
     *
     * @param  string  $pipelineId
     * @param  int  $buildNumber
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteById($pipelineId, $buildNumber, array $parameters)
    {
        return $this->execute('delete', "pipelines/{$pipelineId}/builds/{$buildNumber}", $parameters, true);
    }

    /**
     * Get the Api to call agains
     *
     * @return string
     */
    public function getApi()
    {
        return 'rest/builds/0.1';
    }

}
