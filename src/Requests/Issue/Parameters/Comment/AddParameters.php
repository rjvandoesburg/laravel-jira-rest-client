<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters\Comment;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class AddParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters\Comments
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-comment-post
 */
class AddParameters extends AbstractParameters
{
    /**
     * @var array
     */
    public $author;

    /**
     * @var string
     */
    public $body;

    /**
     * @var string
     */
    public $created;

    /**
     * @var string
     */
    public $id;

    /**
     * @var array
     */
    public $properties;

    /**
     * @var string
     */
    public $renderedBody;

    /**
     * @var string
     */
    public $self;

    /**
     * @var array
     */
    public $updateAuthor;

    /**
     * @var string
     */
    public $updated;

    /**
     * @var array
     */
    public $visibility;
}