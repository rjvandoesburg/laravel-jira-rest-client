<?php

namespace Atlassian\JiraRest\Requests\Agile\Board\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class GetAllParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Board\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-get
 */
class GetAllParameters extends AbstractParameters
{
    /**
     * The maximum number of boards to return per page. Default: 50. See the ‘Pagination’ section at the top of this
     * page for more details.
     *
     * @var int
     */
    public $maxResults = 50;

    /**
     * Filters results to boards that match or partially match the specified name.
     *
     * @var string
     */
    public $name;

    /**
     * Filters results to boards that are relevant to a project. Relevance means that the jql filter defined in board
     * contains a reference to a project.
     *
     * @var string
     */
    public $projectKeyOrId;

    /**
     * @var string
     */
    public $projectLocation;

    /**
     * The starting index of the returned boards. Base index: 0.
     *
     * @var int
     */
    public $startAt;

    /**
     * Filters results to boards of the specified type. Valid values: scrum, kanban.
     *
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $userkeyLocation;

    /**
     * @var string
     */
    public $usernameLocation;
}
