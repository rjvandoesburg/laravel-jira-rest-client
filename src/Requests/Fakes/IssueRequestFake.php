<?php

namespace Atlassian\JiraRest\Requests\Fakes;

use Atlassian\JiraRest\Requests\Issue\IssueRequest;

class IssueRequestFake extends IssueRequest
{
    /**
     * Execute the request and return the response as a stream
     *
     * @param string $method
     * @param string $resource
     * @param array $parameters
     * @param bool $asQueryParameters Some non-GET requests require sending query parameters instead.
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    protected function execute($method, $resource, $parameters = [], $asQueryParameters = false)
    {
        $calledMethod = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1]['function'];

        if (file_exists($filename = __DIR__."/issue_request/{$calledMethod}.json")) {
            return new \GuzzleHttp\Psr7\Response(200, [], file_get_contents($filename));
        }

        return new \GuzzleHttp\Psr7\Response(204, [], null);
    }
}