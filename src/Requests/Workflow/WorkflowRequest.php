<?php

namespace Atlassian\JiraRest\Requests\User;

use Atlassian\JiraRest\Requests\AbstractRequest;

class WorkflowRequest extends AbstractRequest
{
    /**
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllStatuses()
    {
        return $this->execute('get', 'status');
    }

    /**
     * Get the Api to call agains
     *
     * @return string
     */
    public function getApi()
    {
        return 'rest/api/3';
    }
}