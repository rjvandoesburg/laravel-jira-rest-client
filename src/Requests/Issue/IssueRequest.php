<?php

namespace Atlassian\JiraRest\Requests\Issue;

use Atlassian\JiraRest\Requests\AbstractRequest;
use Atlassian\JiraRest\Requests\Issue\Parameters\UpdateOrCreateParameters;
use Atlassian\JiraRest\Requests\Issue\Parameters\DeleteParameters;
use Atlassian\JiraRest\Requests\Issue\Parameters\GetParameters;
use Atlassian\JiraRest\Requests\Issue\Parameters\SearchParameters;
use Atlassian\JiraRest\Requests\Issue\Parameters\EditParameters;
use Atlassian\JiraRest\Requests\Issue\Traits;

/**
 * Class IssueRequest
 *
 * @package Atlassian\JiraRest\Requests\Issue
 */
class IssueRequest extends AbstractRequest
{
    use Traits\PropertiesRequests;
    use Traits\TransitionsRequests;
    use Traits\CommentRequests;

    /**
     * Creates an issue or a sub-task from a JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-post
     *
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\UpdateOrCreateParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function create($parameters = [])
    {
        $this->validateParameters($parameters, UpdateOrCreateParameters::class);

        return $this->execute('post', 'issue', $parameters);
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
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function get($issueIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, GetParameters::class);

        return $this->execute('get', "issue/{$issueIdOrKey}", $parameters);
    }

    /**
     * Edits the issue from a JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-put
     *
     * @param string|int $issueIdOrKey
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\UpdateOrCreateParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function edit($issueIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, UpdateOrCreateParameters::class);

        return $this->execute('put', "issue/{$issueIdOrKey}", $parameters);
    }

    /**
     * Deletes an individual issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-delete
     *
     * @param string|int $issueIdOrKey ID or key of the issue to be deleted.
     * @param bool $deleteSubtasks A true or false value indicating if sub-tasks should be deleted.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function delete($issueIdOrKey, $deleteSubtasks = false)
    {
        return $this->execute('delete', "issue/{$issueIdOrKey}", ['deleteSubtasks' => $deleteSubtasks], true);
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
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function search($parameters)
    {
        $this->validateParameters($parameters, SearchParameters::class);

        return $this->execute('get', 'search', $parameters);
    }

    /**
     * Assigns the issue to the user.
     * Use this resource to assign issues for the users having “Assign Issue” permission, and not having the “Edit Issue” permission.
     * If name body parameter is set to “-1” then automatic issue assignee is used. A name set to null will remove the assignee.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-assignee-put
     *
     * @param string|int $issueIdOrKey
     */
    public function assign($issueIdOrKey)
    {
        // TODO: implement
    }

    /**
     * Add one or more attachments to an issue.
     * This resource expects a multipart post. The media-type multipart/form-data is defined in RFC 1867. Most client libraries have classes that make dealing with multipart posts simple. For instance, in Java the Apache HTTP Components library provides a MultiPartEntity that makes it simple to submit a multipart POST.
     * In order to protect against XSRF attacks, because this method accepts multipart/form-data, it has XSRF protection on it. This means you must submit a header of X-Atlassian-Token: no-check with the request, otherwise it will be blocked.
     * The name of the multipart/form-data parameter that contains attachments must be “file”
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-attachments-post
     *
     * @param string|int $issueIdOrKey
     */
    public function addAttachment($issueIdOrKey)
    {
        // TODO: implement
    }

    /**
     * Returns a paginated list of all updates of an issue, sorted by date, starting from the oldest.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-changelog-get
     *
     * @param string|int $issueIdOrKey
     */
    public function getChangeLogs($issueIdOrKey)
    {
        // TODO: implement
    }

    /**
     * Returns the metadata for editing an issue.
     * The fields returned by editmeta resource are the ones shown on the issue’s Edit screen. Fields hidden from the screen will not be returned unless overrideScreenSecurity parameter is set to true.
     * If an issue cannot be edited in Jira because of its workflow status (for example the issue is closed), then no fields will be returned, unless overrideEditableFlag is set to true.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-editmeta-get
     *
     * @param string|int $issueIdOrKey
     */
    public function getEditMeta($issueIdOrKey)
    {
        // TODO: implement
    }

    /**
     * Sends an email notification to the list of users defined in the request body parameters.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-notify-post
     *
     * @param string|int $issueIdOrKey
     */
    public function notify($issueIdOrKey)
    {
        // TODO: implement
    }


}