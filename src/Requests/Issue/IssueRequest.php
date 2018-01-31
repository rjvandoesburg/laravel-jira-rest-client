<?php

namespace Atlassian\JiraRest\Requests\Issue;

use Atlassian\JiraRest\Requests\AbstractRequest;
use Atlassian\JiraRest\Requests\Issue\Parameters\CreateParameters;
use Atlassian\JiraRest\Requests\Issue\Parameters\DeleteParameters;
use Atlassian\JiraRest\Requests\Issue\Parameters\GetParameters;
use Atlassian\JiraRest\Requests\Issue\Parameters\SearchParameters;
use Atlassian\JiraRest\Requests\Issue\Parameters\EditParameters;

class IssueRequest extends AbstractRequest
{
    /**
     * Api resource to hit
     *
     * @var string
     */
    protected $resource = 'issue';

    /**
     * Creates an issue or a sub-task from a JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-post
     *
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\CreateParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \TypeError
     */
    public function create($parameters = [])
    {
        $this->validateParameters($parameters, CreateParameters::class);

        return $this->execute('post', $parameters);
    }

    /**
     * Returns a full representation of the issue for the given issue key.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-get
     *
     * @param string|int $issueIdOrKey
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\GetParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \TypeError
     */
    public function get($issueIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, GetParameters::class);

        $this->setResource("issue/{$issueIdOrKey}");

        return $this->execute('get', $parameters);
    }

    /**
     * Edits the issue from a JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-put
     *
     * @param string|int $issueIdOrKey
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\EditParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \TypeError
     */
    public function edit($issueIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, EditParameters::class);

        $this->setResource("issue/{$issueIdOrKey}");

        return $this->execute('put', $parameters);
    }

    /**
     * Deletes an individual issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-delete
     *
     * @param string|int $issueIdOrKey
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\DeleteParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \TypeError
     */
    public function delete($issueIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, DeleteParameters::class);

        $this->setResource("issue/{$issueIdOrKey}");

        return $this->execute('delete', $parameters);
    }

    /**
     * Searches for issues using JQL.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-search-get
     *
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\SearchParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \TypeError
     */
    public function search($parameters)
    {
        $this->validateParameters($parameters, SearchParameters::class);

        $this->setResource('search');

        return $this->execute('post', $parameters);
    }

}