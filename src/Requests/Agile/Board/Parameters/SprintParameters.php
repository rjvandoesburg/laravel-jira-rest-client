<?php

namespace Atlassian\JiraRest\Requests\Agile\Board\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class SprintParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Board\Parameters
 */
class SprintParameters extends AbstractParameters
{
    /**
     * The maximum number of boards to return per page.
     * page for more details.
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
     * Filters results to sprints in specified states. Valid values: future, active, closed.
     * You can define multiple states separated by commas, e.g. state=active,closed
     *
     * @var string
     */
    public $state;
}
