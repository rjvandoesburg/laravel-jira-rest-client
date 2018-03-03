<?php

namespace Atlassian\JiraRest\Requests\Project\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class NotificationSchemaParameters
 *
 * @package Atlassian\JiraRest\Requests\Project\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectKeyOrId-notificationscheme-get
 */
class NotificationSchemaParameters extends AbstractParameters
{
    /**
     * Multi-value parameter defining request properties to expand in the response.
     *
     * @var string
     */
    public $expand;
}