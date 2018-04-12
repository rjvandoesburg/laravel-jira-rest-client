<?php

namespace Atlassian\JiraRest\Requests\Fakes;

use Atlassian\JiraRest\Requests\Issue\IssueRequest;
use Illuminate\Support\Arr;
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
            case 'create':
            case 'addComment':
                return 201;
            case 'edit':
            case 'doTransition':
                return 204;
            default:
                return 200;
        }
    }

    /**
     * Format the body back
     *
     * @param $content
     * @param array $parameters
     *
     * @return string
     */
    protected function formatCreateBody($content, $parameters = [])
    {
        $projectKey = Arr::get($parameters, 'fields.project.key');
        if (empty($projectKey)) {
            return $content;
        }

        $body = json_decode($content, true);
        $body = recursive_array_replace('TESP', $projectKey, $body);

        return json_encode($body);
    }

    /**
     * Format the body back
     *
     * @param $content
     * @param array $parameters
     *
     * @return string
     */
    protected function formatGetBody($content, $parameters = [])
    {
        $projectKey = Arr::get($parameters, 'fields.project.key');
        if (empty($projectKey)) {
            return $content;
        }

        $body = json_decode($content, true);
        $body = recursive_array_replace('TESP', $projectKey, $body);

        return json_encode($body);
    }

    /**
     * Format the body back
     *
     * @param $content
     * @param array $parameters
     *
     * @return string
     */
    protected function formatSearchBody($content, $parameters = [])
    {
        // key = TESP-29
        // project = TESP
        preg_match("#(?:key\s?=\s?(\w+)-\d+|project\s?=\s?(\w+))#", Arr::get($parameters, 'jql'), $matches);
        if (empty($projectKey = Arr::get($matches, '1'))) {
            return $content;
        }

        $body = json_decode($content, true);
        $body = recursive_array_replace('TESP', $projectKey, $body);

        return json_encode($body);
    }
}