<?php

namespace Atlassian\JiraRest\Requests\Issue;

use Atlassian\JiraRest\Requests\AbstractRequest;
use Atlassian\JiraRest\Requests\Issue\Traits;

/**
 * Class IssueRequest
 *
 * @package Atlassian\JiraRest\Requests\Issue
 */
class IssueRequest extends AbstractRequest
{
    use Traits\PropertiesRequests;
    use Traits\CommentRequests;
    use Traits\WorklogsRequests;

    /**
     * Creates an issue or a sub-task from a JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-post
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($parameters = [])
    {
        return $this->execute('post', 'issue', $parameters);
    }

    /**
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-bulk-post
     * @throws \Exception
     */
    public function bulkCreate()
    {
        // TODO: implement
        throw new \Exception('Not yet implemented');
    }

    /**
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-createmeta-get
     * @throws \Exception
     */
    public function getCreateMetadata()
    {
        // TODO: implement
        throw new \Exception('Not yet implemented');
    }

    /**
     * Returns a full representation of the issue for the given issue key.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-get
     *
     * @param  string|int  $issueIdOrKey
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($issueIdOrKey, $parameters = [])
    {
        return $this->execute('get', "issue/{$issueIdOrKey}", $parameters);
    }

    /**
     * Edits the issue from a JSON representation.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-put
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
    public function edit($issueIdOrKey, $parameters = [])
    {
        return $this->execute('put', "issue/{$issueIdOrKey}", $parameters);
    }

    /**
     * Deletes an individual issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-delete
     *
     * @param  string|int  $issueIdOrKey  ID or key of the issue to be deleted.
     * @param  bool  $deleteSubtasks  A true or false value indicating if sub-tasks should be deleted.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($issueIdOrKey, $deleteSubtasks = false)
    {
        return $this->execute('delete', "issue/{$issueIdOrKey}", ['deleteSubtasks' => $deleteSubtasks], true);
    }

    /**
     * Searches for issues using JQL.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-search-get
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     * @param  bool  $asGet
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TypeError
     */
    public function search($parameters, $asGet = true)
    {
        return $this->execute($asGet ? 'get' : 'post', 'search', $parameters);
    }

    /**
     * Assigns the issue to the user.
     * Use this resource to assign issues for the users having “Assign Issue” permission, and not having the “Edit
     * Issue” permission. If name body parameter is set to “-1” then automatic issue assignee is used. A name set to
     * null will remove the assignee.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-assignee-put
     *
     * @param  string|int  $issueIdOrKey
     *
     * @throws \Exception
     */
    public function assign($issueIdOrKey)
    {
        // TODO: implement
        throw new \Exception('Not yet implemented');
    }

    /**
     * Returns a paginated list of all updates of an issue, sorted by date, starting from the oldest.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-changelog-get
     *
     * @param  string|int  $issueIdOrKey
     *
     * @throws \Exception
     */
    public function getChangeLogs($issueIdOrKey)
    {
        // TODO: implement
        throw new \Exception('Not yet implemented');
    }

    /**
     * Returns the metadata for editing an issue.
     * The fields returned by editmeta resource are the ones shown on the issue’s Edit screen. Fields hidden from the
     * screen will not be returned unless overrideScreenSecurity parameter is set to true. If an issue cannot be edited
     * in Jira because of its workflow status (for example the issue is closed), then no fields will be returned,
     * unless overrideEditableFlag is set to true.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-editmeta-get
     *
     * @param  string|int  $issueIdOrKey
     *
     * @throws \Exception
     */
    public function getEditMetadata($issueIdOrKey)
    {
        // TODO: implement
        throw new \Exception('Not yet implemented');
    }

    /**
     * Sends an email notification to the list of users defined in the request body parameters.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-notify-post
     *
     * @param  string|int  $issueIdOrKey
     *
     * @throws \Exception
     */
    public function notify($issueIdOrKey)
    {
        // TODO: implement
        throw new \Exception('Not yet implemented');
    }

    /**
     * Returns a list of transitions available for this issue for the current user.
     * Specify expand=transitions.fields parameter to retrieve the fields required for a transition together with their
     * types. Fields metadata corresponds to the fields available in a transition screen for a particular transition.
     * Fields hidden from the screen will not be returned in the metadata.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-transitions-get
     *
     * @param  string|int  $issueIdOrKey  ID or key of the issue to return transitions for.
     * @param  \Atlassian\JiraRest\Requests\Issue\Parameters\Transitions\GetTransitionsParameters|array
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTransitions($issueIdOrKey, $parameters = [])
    {
        return $this->execute('get', "issue/{$issueIdOrKey}/transitions", $parameters);
    }

    /**
     * Performs the issue transition.
     * While performing the transition you can modify other issue fields.
     * The fields that can be set on transiton, in either fields or update parameter can be determined using the
     * /rest/api/2/issue/{issueIdOrKey}/transitions?expand=transitions.fields resource. If a field is not configured to
     * appear on the transition screen, it will not be returned in the transition metadata. A field validation error
     * will occur if such field is submitted in issue transition request.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-transitions-post
     *
     * @param  string|int  $issueIdOrKey  ID or key of the issue to transition.
     * @param  \Atlassian\JiraRest\Requests\Issue\Parameters\Transitions\DoTransitionsParameters|array
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function doTransition($issueIdOrKey, $parameters)
    {
        return $this->execute('post', "issue/{$issueIdOrKey}/transitions", $parameters);
    }
}
