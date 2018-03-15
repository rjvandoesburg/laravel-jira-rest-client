<?php

namespace Atlassian\JiraRest\Requests\Agile\Board\Parameters;

use Modules\Jira\Requests\RequestParametersBase;

class CreateParameters extends RequestParametersBase
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