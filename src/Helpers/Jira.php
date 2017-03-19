<?php

namespace Atlassian\JiraRest\Helpers;

class Jira
{

    public function projects()
    {
        return new Projects();
    }

    public function issues()
    {
        return new Issues();
    }
}