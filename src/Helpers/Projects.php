<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\Project\ProjectRequest;

class Projects
{
    public function all()
    {
        $request = new ProjectRequest();

        return $request->get();
    }

    public function get($project)
    {
        $request = new ProjectRequest($project);

        return $request->get();
    }

}