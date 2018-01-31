<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class DeleteParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-delete
 */
class DeleteParameters extends AbstractParameters
{

    /**
     * A true or false value indicating if sub-tasks should be deleted.
     * If the issue has no sub-tasks this parameter is ignored.
     * If the issue has sub-tasks and parameter is either not specified or set to false then the issue will not be
     * deleted, and an error will be returned.
     *
     * @var bool
     */
    public $deleteSubtasks;
}