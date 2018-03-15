<?php

namespace Atlassian\JiraRest\Requests\Agile\Sprint\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class UpdateParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Sprint\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-post
 */
class UpdateParameters extends AbstractParameters
{
    /**
     * @var string
     */
    public $completeDate;

    /**
     * @var string
     */
    public $endDate;

    /**
     * @var string
     */
    public $goal;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $originBoardId;

    /**
     * @var string
     */
    public $self;

    /**
     * @var string
     */
    public $startDate;

    /**
     * @var string
     */
    public $state;
}
