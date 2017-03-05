<?php

namespace Rjvandoesburg\Jira\Requests\Issue;

use Rjvandoesburg\Jira\Requests\BaseRequest;

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