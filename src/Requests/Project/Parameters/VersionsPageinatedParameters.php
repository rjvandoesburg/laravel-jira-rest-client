<?php

namespace Atlassian\JiraRest\Requests\Project\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class VersionsPageinatedParameters
 *
 * @package Atlassian\JiraRest\Requests\Project\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-version-get
 */
class VersionsPageinatedParameters extends AbstractParameters
{
    /**
     * Multi-value parameter defining request properties to expand in the response.
     * These are not returned by default. Allowed values:
     * - remotelinks - remote version links.
     * - operations - actions available to perform on specified version.
     *  -issuesstatus - calculate number of issues in status categories for version.
     *
     * @var string
     */
    public $expand;

    /**
     * The maximum number of issues to return (defaults to 50).
     *
     * @var int
     */
    public $maxResults = 50;

    /**
     * Ordering of the results by a given field from the following:
     * - sequence
     * - name
     * - startDate
     * - releaseDate
     *
     * @var string
     */
    public $orderBy;

    /**
     * A string used to filter the results, only versions with matching name or description will be returned (letter case is ignored)
     *
     * @var string
     */
    public $query;

    /**
     * The starting index of the returned boards. Base index: 0.
     *
     * @var int
     */
    public $startAt = 0;

    /**
     * A comma separated string used to filter the results by version status, possible values:
     * - released
     * - unreleased
     * - archived
     *
     * @var string
     */
    public $status;
}