<?php

namespace Atlassian\JiraRest\Requests\User\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class SearchParameters
 *
 * @package Atlassian\JiraRest\Requests\User\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-user-search-get
 */
class SearchParameters extends AbstractParameters
{

    /**
     * A query string used to search username, name or e-mail address
     *
     * @var string
     */
    public $username;

    /**
     * The index of the first user to return (0-based)
     * @var int
     */
    public $startAt;

    /**
     * The maximum number of users to return.
     * The maximum allowed value is 1000.
     * If you specify a value that is higher than this number, your search results will be truncated.
     *
     * @var int
     */
    public $maxResults = 1000;

    /**
     * If true, then active users are included in the results
     *
     * @var bool
     */
    public $includeActive = true;

    /**
     * If true, then inactive users are included in the results
     *
     * @var bool
     */
    public $includeInactive = false;
}