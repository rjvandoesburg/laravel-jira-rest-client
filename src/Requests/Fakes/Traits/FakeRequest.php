<?php

namespace Atlassian\JiraRest\Requests\Fakes\Traits;

use Atlassian\JiraRest\Requests\AbstractParameters;
use Illuminate\Support\Str;

trait FakeRequest
{
    /**
     * Determine if a get mutator exists for an attribute.
     *
     * @param  string $key
     *
     * @return bool
     */
    public function hasFormatMutator($key)
    {
        return method_exists($this, 'format'.Str::studly($key).'Body');
    }

    /**
     * Execute the request and return the response as a stream
     *
     * @param string $method
     * @param string $resource
     * @param array $parameters
     * @param bool $asQueryParameters Some non-GET requests require sending query parameters instead.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \ReflectionException
     */
    protected function execute($method, $resource, $parameters = [], $asQueryParameters = false)
    {
        $reflection = new \ReflectionClass(static::class);

        // Check if the parameters is an array or an instance of AbstractParameters
        if ($parameters instanceof AbstractParameters) {
            $parameters = $parameters->toArray();
        }
        $calledMethod = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1]['function'];

        // Remove the _fake from the dirname
        $dirname = str_replace('_fake', '', Str::snake($reflection->getShortName()));

        // Check in a subdirectory of the current fake if there is a json response
        if (! file_exists($filename = dirname($reflection->getFileName())."/{$dirname}/{$calledMethod}.json")) {
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
        return 200;
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