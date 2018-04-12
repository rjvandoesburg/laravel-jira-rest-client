<?php

namespace Atlassian\JiraRest\Requests\Fakes\Agile;

use Atlassian\JiraRest\Requests\Agile\Issue\IssueRequest;
use Atlassian\JiraRest\Requests\Fakes\Traits\FakeRequest;

class IssueRequestFake extends IssueRequest
{
    use FakeRequest;

    /**
     * Get the status code for the given method
     *
     * @param $calledMethod
     *
     * @return int
     */
    protected function getStatusCode($calledMethod)
    {
        switch ($calledMethod) {
            case 'rank':
                return 204;
            default:
                return 200;
        }
    }
}