<?php

namespace Atlassian\JiraRest\Requests\Agile\Sprint\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class CreateParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Sprint\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-post
 */
class CreateParameters extends AbstractParameters
{
    /**
     * @var string
     */
    public $endDate;

    /**
     * @var string
     */
    public $goal;

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
    public $startDate;
}
