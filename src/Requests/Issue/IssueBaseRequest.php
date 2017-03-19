<?php

namespace Atlassian\JiraRest\Requests\Issue;

use Atlassian\JiraRest\Requests\BaseRequest;

class IssueBaseRequest extends BaseRequest
{

    /**
     * Get the resource to call
     *
     * @return string
     */
    public function getResource()
    {
        return 'issue';
    }
}