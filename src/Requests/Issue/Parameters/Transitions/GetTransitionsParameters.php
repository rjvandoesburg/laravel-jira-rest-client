<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters\Transitions;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class GetTransitionsParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters\Transitions
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-transitions-get
 */
class GetTransitionsParameters extends AbstractParameters
{
    /**
     * Flag to skip evaluation of {@link RemoteOnlyCondition}. Can only be used by add-on users.
     *
     * @var bool
     */
    public $skipRemoteOnlyCondition = false;

    /**
     * @var string
     */
    public $transitionId;
}