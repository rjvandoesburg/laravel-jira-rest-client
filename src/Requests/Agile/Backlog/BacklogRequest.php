<?php

namespace Atlassian\JiraRest\Requests\Agile\Backlog;

use Atlassian\JiraRest\Requests\Agile\AbstractRequest;

/**
 * Class BacklogRequest
 *
 * @package Atlassian\JiraRest\Requests\Agile\Sprint
 */
class BacklogRequest extends AbstractRequest
{
    /**
     * Move issues to the backlog.
     *
     * This operation is equivalent to remove future and active sprints from a given set of issues.
     * At most 50 issues may be moved at once.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-agile-1-0-backlog-issue-post
     *
     * @param  array  $issues  A list of both issue id or key are accepted.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function moveIssues(array $issues)
    {
        return $this->execute('post', 'backlog/issue', ['issues' => $issues]);
    }

    /**
     * Move issues to the backlog of a particular board (if they are already on that board).
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-rest-agile-1-0-backlog-boardId-issue-post
     *
     * @param  int  $boardId
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function moveIssueForBoard($boardId, array $parameters)
    {
        return $this->execute('post', "backlog/{$boardId}/issue", $parameters);
    }
}
