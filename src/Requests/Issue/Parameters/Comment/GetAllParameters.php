<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters\Comment;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class GetAllParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters\Comments
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-comment-get
 *
 * @deprecated Use your own abstraction of \Atlassian\JiraRest\Requests\AbstractParameters or use an array instead
 */
class GetAllParameters extends AbstractParameters
{
    /**
     * @var string
     */
    public $expand;

    /**
     * How many results on the page should be included.
     *
     * @var int
     */
    public $maxResults = 50;

    /**
     * Ordering of the results.
     *
     * @var string
     */
    public $orderBy;

    /**
     * @var int The page offset.
     */
    public $startAt = 0;
}