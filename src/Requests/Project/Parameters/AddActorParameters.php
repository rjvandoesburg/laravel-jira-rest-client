<?php

namespace Atlassian\JiraRest\Requests\Project\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class AddActorParameters
 *
 * @package Atlassian\JiraRest\Requests\Project\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-post
 */
class AddActorParameters extends AbstractParameters
{
    /**
     * @var array|string[]
     */
    public $group;

    /**
     * @var array|string[]
     */
    public $user;
}