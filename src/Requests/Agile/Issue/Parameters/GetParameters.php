<?php

namespace Atlassian\JiraRest\Requests\Agile\Issue\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class GetParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Issue\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-issue-issueIdOrKey-get
 */
class GetParameters extends AbstractParameters
{
    /**
     * A comma-separated list of the parameters to expand.
     *
     * @var string
     */
    public $expand;

    /**
     * The list of fields to return for each issue.
     * By default, all navigable and Agile fields are returned.
     *
     * @var array|string[]
     */
    public $fields;

    /**
     * A boolean indicating whether the issue retrieved by this method should be added to the current user’s issue history.
     *
     * @var bool
     */
    public $updateHistory;
}
