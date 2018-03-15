<?php

namespace Atlassian\JiraRest\Requests\Agile\Board\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class VersionsParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Board\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-version-get
 */
class VersionsParameters extends AbstractParameters
{

    /**
     * The maximum number of boards to return per page.
     *
     * @var int
     */
    public $maxResults = 100;

    /**
     * Filters results to versions that are either released or unreleased.
     *
     * @var bool
     */
    public $released;

    /**
     * The starting index of the returned boards. Base index: 0.
     *
     * @var int
     */
    public $startAt = 0;
}
