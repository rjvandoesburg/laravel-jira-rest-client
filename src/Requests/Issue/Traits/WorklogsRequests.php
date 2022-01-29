<?php

namespace Atlassian\JiraRest\Requests\Issue\Traits;

trait WorklogsRequests
{
    /**
     * Returns all worklogs for an issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-worklog-get
     *
     * @param  string|int  $issueIdOrKey
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TypeError
     */
    public function getWorklogs($issueIdOrKey, $parameters = [])
    {
        return $this->execute('get', "issue/{$issueIdOrKey}/worklog", $parameters);
    }

    /**
     * Adds a worklog to an issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-worklog-post
     *
     * @param  string|int  $issueIdOrKey
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TypeError
     */
    public function addWorklog($issueIdOrKey, $parameters = [])
    {
        return $this->execute('post', "issue/{$issueIdOrKey}/worklog", $parameters);
    }

    /**
     * Returns a worklog.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-worklog-id-get
     *
     * @param  string|int  $issueIdOrKey
     * @param  int  $workdlogId
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TypeError
     */
    public function getWorklog($issueIdOrKey, $workdlogId, $parameters = [])
    {
        return $this->execute('get', "issue/{$issueIdOrKey}/worklog/{$workdlogId}", $parameters);
    }

    /**
     * Updates a worklog.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-worklog-id-put
     *
     * @param  string|int  $issueIdOrKey
     * @param  int  $workdlogId
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TypeError
     */
    public function updateWorklog($issueIdOrKey, $workdlogId, $parameters = [])
    {
        return $this->execute('put', "issue/{$issueIdOrKey}/worklog/{$workdlogId}", $parameters);
    }

    /**
     * Updates a worklog.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-worklog-id-put
     *
     * @param  string|int  $issueIdOrKey
     * @param  int  $workdlogId
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TypeError
     *
     * @deprecated Use updateWorklog instead
     */
    public function putWorklog($issueIdOrKey, $workdlogId, $parameters = [])
    {
        return $this->updateWorklog($issueIdOrKey, $workdlogId, $parameters);
    }

    /**
     * Deletes a worklog from an issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-worklog-id-delete
     *
     * @param  string|int  $issueIdOrKey
     * @param  int  $workdlogId
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TypeError
     */
    public function deleteWorklog($issueIdOrKey, $workdlogId, $parameters = [])
    {
        return $this->execute('delete', "issue/{$issueIdOrKey}/worklog/{$workdlogId}", $parameters);
    }


    /**
     * Returns a list of IDs and update timestamps for worklogs updated after a date and time.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-issue-worklogs/#api-rest-api-3-worklog-updated-get
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TypeError
     */
    public function getUpdatedWorklogs($parameters = [])
    {
        return $this->execute('get', "worklog/updated", $parameters);
    }


    /**
     * Returns the worklogs with all the information
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-issue-worklogs/#api-rest-api-3-worklog-updated-get
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TypeError
     */
    public function getRealWorklogs($parameters = [])
    {
        return $this->execute('post', "worklog/list", $parameters);
    }

    /**
     * Returns the ids of all deleted worklogs
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-issue-worklogs/#api-rest-api-3-worklog-updated-get
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TypeError
     */
    public function getDeletedWorklogs($parameters = [])
    {
        return $this->execute('get', "worklog/deleted", $parameters);
    }
}
