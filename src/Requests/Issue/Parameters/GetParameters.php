<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class GetParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-get
 */
class GetParameters extends AbstractParameters
{
    /**
     * This parameter is currently not used.
     *
     * @var string
     */
    public $expand;

    /**
     * The list of fields to return for each issue. By default, all navigable and Agile fields are returned.
     *
     * @var string
     */
    public $fields;

    /**
     * If true then issue fields are referenced by keys instead of IDs.
     *
     * @var bool
     */
    public $fieldsByKeys;

    /**
     * Multi-value parameter defining the list of properties returned for the issue.
     * Unlike fields, properties are not included in the response by default.
     *
     * @var string
     */
    public $properties;

    /**
     * If set to true, adds the issue retrieved by this method to the current user’s issue history.
     * Issue history is shown under Issues menu item in Jira, and is also used by lastViewed JQL field in an issue
     * search. By default the issue history is not updated.
     *
     * @var bool
     */
    public $updateHistory;
}