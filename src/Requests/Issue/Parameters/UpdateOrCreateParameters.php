<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class UpdateOrCreateParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-post
 */
class UpdateOrCreateParameters extends AbstractParameters
{
    /**
     * @var array
     */
    public $fields;

    /**
     * @var array
     */
    public $historyMetadata;

    /**
     * @var array
     */
    public $issueList;

    /**
     * @var array
     */
    public $properties;

    /**
     * @var array
     */
    public $transition;

    /**
     * @var array
     */
    public $update;
}