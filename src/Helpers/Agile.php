<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Helpers\Agile\Board;
use Atlassian\JiraRest\Helpers\Agile\Boards;
use Atlassian\JiraRest\Helpers\Agile\Sprint;

class Agile
{
    /**
     * @return \Atlassian\JiraRest\Helpers\Agile\Boards
     */
    public function boards()
    {
        return new Boards;
    }

    /**
     * @param int $boardId
     *
     * @return \Atlassian\JiraRest\Helpers\Agile\Board
     */
    public function board($boardId)
    {
        return new Board($boardId);
    }

    /**
     * @param $sprintId
     *
     * @return \Atlassian\JiraRest\Helpers\Agile\Sprint
     */
    public function sprint($sprintId)
    {
        return new Sprint($sprintId);
    }
}