<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class EditParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-put
 */
class EditParameters extends AbstractParameters
{
    /**
     * Send the email with notification that the issue was updated to users that watch it.
     * Admin or project admin permissions are required to disable the notification.
     *
     * @var bool
     */
    public $notifyUsers = true;

    /**
     * Updates the issue even if it is not editable (issue in status with jira.issue.editable set to false or missing).
     * Only connect add-on users with admin scope permission are allowed to use this flag.
     *
     * @var bool
     */
    public $overrideEditableFlag = false;

    /**
     * Allows update of the fields that are hidden from the issue’s Edit screen.
     * Only Connect add-on users with admin scope permission are allowed to use this flag.
     *
     * @var bool
     */
    public $overrideScreenSecurity = false;

    /**
     * The body
     *
     * @var string
     */
    public $update;
}