<?php

namespace Atlassian\JiraRest\Requests\Group\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class FindParameters
 *
 * @package Atlassian\JiraRest\Requests\Group\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-api-3-groups-picker-get
 *
 * @deprecated Use your own abstraction of \Atlassian\JiraRest\Requests\AbstractParameters or use an array instead
 */
class FindParameters extends AbstractParameters
{

    /**
     * Parameter not in use.
     *
     * @var string
     */
    public $accountId;

    /**
     * The string to find in group names.
     *
     * @var string
     */
    public $query;

    /**
     * A list of groups to exclude from the result.
     *
     * @var string
     */
    public $exclude;

    /**
     * The maximum number of groups to return.
     * The maximum number of groups that can be returned is limited by the system property jira.ajax.autocomplete.limit.
     *
     * @var int
     */
    public $maxResults;

    /**
     * Parameter not in use.
     *
     * @var string
     */
    public $userName;
}