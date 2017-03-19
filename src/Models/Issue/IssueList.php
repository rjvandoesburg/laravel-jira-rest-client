<?php

namespace Atlassian\JiraRest\Models\Issue;

use Atlassian\JiraRest\Models\JiraEloquentModel;

class IssueList extends JiraEloquentModel
{

    public function setIssuesAttribute($issues)
    {
        $collection = collect();
        foreach ($issues as $issue) {
            $collection->push(Issue::fromJira($issue));
        }

        $this->attributes['issues'] = $collection;
    }
}