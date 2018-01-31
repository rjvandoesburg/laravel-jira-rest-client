<?php

namespace Atlassian\JiraRest\Helpers;

class Jira
{
    /**
     * @return \Atlassian\JiraRest\Helpers\Session
     */
    public function session()
    {
        return new Session;
    }

    /**
     * @return \Atlassian\JiraRest\Helpers\Projects
     */
    public function projects()
    {
        return new Projects;
    }

    /**
     * @return \Atlassian\JiraRest\Helpers\Issues
     */
    public function issues()
    {
        return new Issues;
    }
}