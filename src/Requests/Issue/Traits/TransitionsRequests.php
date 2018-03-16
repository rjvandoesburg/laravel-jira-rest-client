<?php

namespace Atlassian\JiraRest\Requests\Issue\Traits;

use Atlassian\JiraRest\Requests\Issue\Parameters\Transitions\DoTransitionsParameters;
use Atlassian\JiraRest\Requests\Issue\Parameters\Transitions\GetTransitionsParameters;

/**
 * Trait PropertyRequests
 *
 * @package Atlassian\JiraRest\Requests\Issue
 *
 * {@inheritdoc}
 */
trait TransitionsRequests
{

    /**
     * Returns a list of transitions available for this issue for the current user.
     * Specify expand=transitions.fields parameter to retrieve the fields required for a transition together with their types.
     * Fields metadata corresponds to the fields available in a transition screen for a particular transition. Fields hidden from the screen will not be returned in the metadata.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-transitions-get
     *
     * @param string|int $issueIdOrKey ID or key of the issue to return transitions for.
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\Transitions\GetTransitionsParameters|array
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function getTransitions($issueIdOrKey, $parameters = [])
    {
        $this->validateParameters($parameters, GetTransitionsParameters::class);

        return $this->execute('get', "issue/{$issueIdOrKey}/transitions", $parameters);
    }

    /**
     * Performs the issue transition.
     * While performing the transition you can modify other issue fields.
     * The fields that can be set on transiton, in either fields or update parameter can be determined using the /rest/api/2/issue/{issueIdOrKey}/transitions?expand=transitions.fields resource.
     * If a field is not configured to appear on the transition screen, it will not be returned in the transition metadata.
     * A field validation error will occur if such field is submitted in issue transition request.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-transitions-post
     *
     * @param string|int $issueIdOrKey ID or key of the issue to transition.
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\Transitions\DoTransitionsParameters|array
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function doTransition($issueIdOrKey, $parameters)
    {
        $this->validateParameters($parameters, DoTransitionsParameters::class);

        return $this->execute('post', "issue/{$issueIdOrKey}/transitions", $parameters);
    }
}