<?php

namespace Atlassian\JiraRest\Requests\Agile;

class FeatureFlagsRequest extends AbstractRequest
{
    /**
     * Update / insert Feature Flag data.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-featureflags-0-1-bulk-post
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
     * Bulk delete all Feature Flags that match the given request.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-featureflags-0-1-bulkByProperties-delete
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
     * Retrieve the currently stored Feature Flag data for the given ID.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-featureflags-0-1-flag-featureFlagId-get
     *
     * @param  string  $featureFlagId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getById($featureFlagId)
    {
        return $this->execute('get', "flag/{$featureFlagId}");
    }

    /**
     * Delete the Feature Flag data currently stored for the given ID.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-featureflags-0-1-flag-featureFlagId-delete
     *
     * @param  string  $featureFlagId
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteById($featureFlagId, array $parameters)
    {
        return $this->execute('delete', "flag/{$featureFlagId}", $parameters, true);
    }

    /**
     * Get the Api to call agains
     *
     * @return string
     */
    public function getApi()
    {
        return 'rest/featureflags/0.1';
    }

}
