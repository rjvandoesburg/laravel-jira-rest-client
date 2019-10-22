<?php

namespace Atlassian\JiraRest\Requests\Issue\Traits;

/**
 * Trait CommentsRequests
 *
 * @package Atlassian\JiraRest\Requests\Issue\Traits
 */
trait CommentRequests
{
    /**
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-comment-list-post
     * @throws \Exception
     */
    public function getCommentsByIds()
    {
        throw new \Exception('Not yet implemented');
    }

    /**
     * Returns all comments for an issue.
     * Results can be ordered by the “created” field which means the date a comment was added.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-comment-get
     *
     * @param  int|string  $issueIdOrKey
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getComments($issueIdOrKey, $parameters = [])
    {
        return $this->execute('get', "issue/{$issueIdOrKey}/comment", $parameters);
    }

    /**
     * Adds a new comment to an issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-comment-post
     *
     * @param  int|string  $issueIdOrKey
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     * @param  string  $expand
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addComment($issueIdOrKey, $parameters, $expand = '')
    {
        return $this->execute('post', "issue/{$issueIdOrKey}/comment?expand={$expand}", $parameters);
    }

    /**
     * Returns a single comment.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-comment-id-get
     *
     * @param  int|string  $issueIdOrKey
     * @param  int  $commentId
     * @param  string  $expand
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getComment($issueIdOrKey, $commentId, $expand = '')
    {
        return $this->execute('get', "issue/{$issueIdOrKey}/comment/{$commentId}", ['expand' => $expand]);
    }

    /**
     * Updates an existing comment using its JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-comment-id-put
     *
     * @param  int|string  $issueIdOrKey
     * @param  int  $commentId
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     * @param  string  $expand
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateComment($issueIdOrKey, $commentId, $parameters, $expand = '')
    {
        return $this->execute('put', "issue/{$issueIdOrKey}/comment/{$commentId}?expand={$expand}", $parameters);
    }

    /**
     * Deletes an existing comment .
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-comment-id-delete
     *
     * @param  int|string  $issueIdOrKey
     * @param  int  $commentId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteComment($issueIdOrKey, $commentId)
    {
        return $this->execute('delete', "issue/{$issueIdOrKey}/comment/{$commentId}");
    }
}
