<?php

namespace Atlassian\JiraRest\Requests\Agile\Board\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class CreateParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Board\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-post
 */
class CreateParameters extends AbstractParameters
{
    /**
     * @var int
     */
    public $filterId;

    /**
     * @var array
     */
    public $location;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;
}
