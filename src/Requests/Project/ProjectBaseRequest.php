<?php

namespace Atlassian\JiraRest\Requests\Project;

use Atlassian\JiraRest\Requests\BaseRequest;

class ProjectBaseRequest extends BaseRequest
{

    /**
     * Get the resource to call
     *
     * @return string
     */
    public function getResource()
    {
        return 'project';
    }
}