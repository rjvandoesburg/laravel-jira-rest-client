<?php

namespace Atlassian\JiraRest\Requests\Agile\Epic\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class UpdateParameters
 *
 * @package Atlassian\JiraRest\Requests\Agile\Epic\Parameters
 * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-epic-epicIdOrKey-post
 */
class UpdateParameters extends AbstractParameters
{
    /**
     * @var string
     */
    public $color;

    /**
     * @var string
     */
    public $done;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $sumary;
}
