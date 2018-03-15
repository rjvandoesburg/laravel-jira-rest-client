<?php

namespace Atlassian\JiraRest\Requests\Agile\Board\Parameters;

use Modules\Jira\Requests\RequestParametersBase;

class ProjectsParameters extends RequestParametersBase
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
}