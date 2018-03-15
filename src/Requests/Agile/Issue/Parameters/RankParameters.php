<?php

namespace Atlassian\JiraRest\Requests\Agile\Issue\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class GetParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Issue\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-issue-issueIdOrKey-get
 */
class RankParameters extends AbstractParameters
{
    /**
     * A list of both issue id or key are accepted.
     *
     * @var array|string[]
     */
    public $issues;

    /**
     * @var string
     */
    public $rankAfterIssue;

    /**
     * @var string
     */
    public $rankBeforeIssue;

    /**
     * @var int
     */
    public $rankCustomFieldId;
}
