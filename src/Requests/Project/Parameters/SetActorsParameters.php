<?php

namespace Atlassian\JiraRest\Requests\Project\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class SetActorsParameters
 *
 * @package Atlassian\JiraRest\Requests\Project\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-put
 */
class SetActorsParameters extends AbstractParameters
{
    /**
     * @var array
     */
    public $categorisedActors;

    /**
     * @var int
     */
    public $id;
}