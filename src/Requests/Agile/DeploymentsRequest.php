<?php

namespace Atlassian\JiraRest\Requests\Agile;

class DeploymentsRequest extends AbstractRequest
{

    /**
     * Update / insert deployment data.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-deployments-0-1-bulk-post
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
     * Bulk delete all deployments that match the given request.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-deployments-0-1-bulkByProperties-delete
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
     * Retrieve the currently stored deployment data for the given pipelineId, environmentId and deploymentSequenceNumber combination.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-deployments-0-1-pipelines-pipelineId-environments-environmentId-deployments-deploymentSequenceNumber-get
     *
     * @param string $pipelineId
     * @param string $environmentId
     * @param int $deploymentSequenceNumber
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getById($pipelineId, $environmentId, $deploymentSequenceNumber)
    {
        return $this->execute('get', "pipelines/{$pipelineId}/environments/{$environmentId}/deployments/{$deploymentSequenceNumber}");
    }

    /**
     * Delete the currently stored deployment data for the given pipelineId, environmentId and deploymentSequenceNumber combination.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-deployments-0-1-pipelines-pipelineId-environments-environmentId-deployments-deploymentSequenceNumber-delete
     *
     * @param string $pipelineId
     * @param string $environmentId
     * @param int $deploymentSequenceNumber
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteById($pipelineId, $environmentId, $deploymentSequenceNumber, array $parameters)
    {
        return $this->execute('delete', "pipelines/{$pipelineId}/environments/{$environmentId}/deployments/{$deploymentSequenceNumber}", $parameters, true);
    }

    /**
     * Get the Api to call agains
     *
     * @return string
     */
    public function getApi()
    {
        return 'rest/deployments/0.1';
    }

}
