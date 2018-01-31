<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class CreateParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-post
 */
class CreateParameters extends AbstractParameters
{
    /**
     * If set to true, adds the issue retrieved by this method to the current user’s issue history.
     * Issue history is shown under Issues menu item in Jira, and is also used by lastViewed JQL field in an issue
     * search. By default the issue history is not updated.
     *
     * @var bool
     */
    public $updateHistory;

    /**
     * The update body
     *
     * @var array
     */
    public $update;

    /**
     * The create body
     *
     * @var array
     */
    public $fields;
}