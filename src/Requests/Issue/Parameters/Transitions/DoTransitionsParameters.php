<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters\Transitions;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class DoTransitionsParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters\Transitions
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-transitions-post
 */
class DoTransitionsParameters extends AbstractParameters
{
    /**
     * @var array
     */
    public $fields;

    /**
     * @var array
     */
    public $historyMetaData;

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