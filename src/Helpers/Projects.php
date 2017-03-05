<?php

namespace Rjvandoesburg\Jira\Helpers;

use Rjvandoesburg\Jira\Requests\Project\ProjectRequest;

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