<?php

namespace Atlassian\JiraRest\Requests\Agile\Board\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class AllSprintsParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Board\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-sprint-get
 */
class SprintsParameters extends AbstractParameters
{

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

    /**
     * Filters results to sprints in specified states.
     * Valid values:
     * - future
     * - active
     * - closed.
     * You can define multiple states separated by commas, e.g. state=active,closed
     *
     * @var string
     */
    public $state;
}
