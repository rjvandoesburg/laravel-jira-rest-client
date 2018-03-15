<?php

namespace Atlassian\JiraRest\Requests\Issue\Comment;

use Atlassian\JiraRest\Requests\AbstractRequest;
use Atlassian\JiraRest\Requests\Issue\Comment\Parameters\AddParameters;
use Atlassian\JiraRest\Requests\Issue\Comment\Parameters\GetAllParameters;
use Atlassian\JiraRest\Requests\Issue\Comment\Parameters\UpdateParameters;

class IssueCommentRequest extends AbstractRequest
{
    /**
     * Returns all comments for an issue.
     * Results can be ordered by the “created” field which means the date a comment was added.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-comment-get
     *
     * @param int|string $issueIdOrKey
     * @param \Atlassian\JiraRest\Requests\Issue\Comment\Parameters\GetAllParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function all($issueIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, GetAllParameters::class);

        return $this->execute('get', "issue/{$issueIdOrKey}/comment", $parameters);
    }

    /**
     * Adds a new comment to an issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-comment-post
     *
     * @param int|string $issueIdOrKey
     * @param \Atlassian\JiraRest\Requests\Issue\Comment\Parameters\AddParameters|array $parameters
     * @param string $expand
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function add($issueIdOrKey, $parameters, $expand = '')
    {
        $this->validateParameters($parameters, AddParameters::class);

        return $this->execute('post', "issue/{$issueIdOrKey}/comment?expand={$expand}", $parameters);
    }

    /**
     * Returns a single comment.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-comment-id-get
     *
     * @param int|string $issueIdOrKey
     * @param int $commentId
     * @param string $expand
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function get($issueIdOrKey, $commentId, $expand = '')
    {
        return $this->execute('get', "issue/{$issueIdOrKey}/comment/{$commentId}", ['expand' => $expand]);
    }

    /**
     * Updates an existing comment using its JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-comment-id-put
     *
     * @param int|string $issueIdOrKey
     * @param int $commentId
     * @param \Atlassian\JiraRest\Requests\Issue\Comment\Parameters\UpdateParameters|array $parameters
     * @param string $expand
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function update($issueIdOrKey, $commentId, $parameters, $expand = '')
    {
        $this->validateParameters($parameters, UpdateParameters::class);

        return $this->execute('put', "issue/{$issueIdOrKey}/comment/{$commentId}?expand={$expand}", $parameters);
    }

    /**
     * Deletes an existing comment .
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-comment-id-delete
     *
     * @param int|string $issueIdOrKey
     * @param int $commentId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function delete($issueIdOrKey, $commentId)
    {
        return $this->execute('delete', "issue/{$issueIdOrKey}/comment/{$commentId}");
    }

}