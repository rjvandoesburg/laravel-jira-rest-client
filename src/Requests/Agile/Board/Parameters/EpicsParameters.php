<?php

namespace Atlassian\JiraRest\Requests\Agile\Board\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class EpicsParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Board\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-epic-get
 */
class EpicsParameters extends AbstractParameters
{
    /**
     * Filters results to epics that are either done or not done.
     *
     * @var bool
     */
    public $done;

    /**
     * The maximum number of boards to return per page.
     *
     * @var int
     */
    public $maxResults = 100;

    /**
     * The starting index of the returned boards. Base index: 0.
     *
     * @var int
     */
    public $startAt = 0;
}
