<?php

namespace Atlassian\JiraRest\Requests\Project\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class DeleteActorParameters
 *
 * @package Atlassian\JiraRest\Requests\Project\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-role-id-delete
 */
class DeleteActorParameters extends AbstractParameters
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