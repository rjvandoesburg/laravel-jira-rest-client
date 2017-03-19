<?php

namespace Atlassian\JiraRest\Requests\Issue;

use Atlassian\JiraRest\Models\Issue\Issue;
use Atlassian\JiraRest\Models\Issue\IssueList;

class IssueRequest extends IssueBaseRequest
{

    protected $issue = null;

    protected $options = [
        'get' => [
            'jql',
            'start_at',
            'max_results',
            'validate_query',
            'fields',
            'expand'
        ]
    ];

    /**
     * @var bool
     */
    protected $raw;

    public function __construct($issue = null, $raw = false)
    {
        $this->issue = $issue;
        $this->raw = $raw;
    }

    /**
     * Get the resource to call
     *
     * @return string
     */
    public function getResource()
    {
        return 'search';
    }

    public function handleResponse($response)
    {
        $response = json_decode($response);

        if ($this->raw) {
            return $response;
        }

        if ($this->issue === null) {
            return IssueList::fromJira($response)->issues;
        }

        return Issue::fromJira($response);
    }

}