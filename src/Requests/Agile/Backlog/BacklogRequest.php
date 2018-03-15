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
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-backlog-issue-post
     *
     * @param array $issues A list of both issue id or key are accepted.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function moveIssues(array $issues)
    {
        return $this->execute('post', 'backlog/issue', ['issues' => $issues]);
    }
}
