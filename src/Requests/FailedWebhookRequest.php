<?php

namespace Atlassian\JiraRest\Requests;

class FailedWebhookRequest extends AbstractRequest
{
    /**
     * Get failed webhooks.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-webhooks/#api-rest-api-3-webhook-failed-get
     *
     * @param  \Atlassian\JiraRest\Requests\Issue\Parameters\Transitions\DoTransitionsParameters|array
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($parameters = [])
    {
        return $this->execute('get', 'webhook/failed', $parameters);
    }
}
