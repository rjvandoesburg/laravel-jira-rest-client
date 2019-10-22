<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class UpdateOrCreateParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-post
 *
 * @deprecated Use your own abstraction of \Atlassian\JiraRest\Requests\AbstractParameters or use an array instead
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