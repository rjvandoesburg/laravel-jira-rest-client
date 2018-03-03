<?php

namespace Atlassian\JiraRest\Requests\Project\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class CreateParameters
 *
 * @package Atlassian\JiraRest\Requests\Project\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-post
 */
class CreateParameters extends AbstractParameters
{
    /**
     * Valid values: PROJECT_LEAD UNASSIGNED
     *
     * @var string
     */
    public $assigneeType;

    /**
     * @var int
     */
    public $avatarId;

    /**
     * @var int
     */
    public $categoryId;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $issueSecurityScheme;

    /**
     * @var string
     */
    public $key;

    /**
     * @var string
     */
    public $lead;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $notificationScheme;

    /**
     * @var int
     */
    public $permissionScheme;

    /**
     * @var string
     */
    public $projectTemplateKey;

    /**
     * @var string
     */
    public $projectTypeKey;

    /**
     * @var string
     */
    public $url;
}