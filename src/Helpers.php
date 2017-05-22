<?php

if (! function_exists('jira')) {
    /**
     * Get the Jira class instance
     *
     * @return \Atlassian\JiraRest\Helpers\Jira
     */
    function jira()
    {
        return app(\Atlassian\JiraRest\Helpers\Jira::class);
    }
}