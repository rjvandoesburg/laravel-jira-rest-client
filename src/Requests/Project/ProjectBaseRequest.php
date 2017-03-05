<?php

namespace Rjvandoesburg\Jira\Requests\Project;

use Rjvandoesburg\Jira\Requests\BaseRequest;

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