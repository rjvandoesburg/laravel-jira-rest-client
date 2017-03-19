<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\Issue\IssueRequest;

class Issues
{
    public function all()
    {
        $request = new IssueRequest();

        return $request->get();
    }

    public function get($issue)
    {
        $request = new IssueRequest($issue);

        return $request->get();
    }

    public function search($jql, $raw = false)
    {
        $request = new IssueRequest(null, $raw);

        return $request->get([
            'jql' => $jql
        ]);
    }

}