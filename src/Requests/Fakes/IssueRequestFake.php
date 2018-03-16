<?php

namespace Atlassian\JiraRest\Requests\Fakes;

use Atlassian\JiraRest\Requests\AbstractParameters;
use Atlassian\JiraRest\Requests\Issue\IssueRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
        // Check if the parameters is an array or an instance of AbstractParameters
        if ($parameters instanceof AbstractParameters) {
            $parameters = $parameters->toArray();
        }
        $calledMethod = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1]['function'];

        if (! file_exists($filename = __DIR__."/issue_request/{$calledMethod}.json")) {
            return new \GuzzleHttp\Psr7\Response(204, [], null);
        }

        $content = file_get_contents($filename);
        if ($this->hasFormatMutator($calledMethod)) {
            $content = $this->mutateBody($calledMethod, $content, $parameters);
        }

        return new \GuzzleHttp\Psr7\Response($this->getStatusCode($calledMethod), [], $content);
    }

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

    /**
     * Determine if a get mutator exists for an attribute.
     *
     * @param  string  $key
     * @return bool
     */
    public function hasFormatMutator($key)
    {
        return method_exists($this, 'format'.Str::studly($key).'Body');
    }

    /**
     * Get the value of an attribute using its mutator.
     *
     * @param  string $key
     * @param  mixed $value
     * @param array $parameters
     *
     * @return mixed
     */
    protected function mutateBody($key, $value, $parameters = [])
    {
        return $this->{'format'.Str::studly($key).'Body'}($value, $parameters);
    }
}