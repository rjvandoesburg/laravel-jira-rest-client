<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\Project\ProjectRequest;

class Projects
{
    /**
     * @var \Atlassian\JiraRest\Requests\Project\ProjectRequest
     */
    protected $request;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->request = app(ProjectRequest::class);
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\GetAllParameters|array $parameters
     *
     * @return array
     *
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function all($parameters = [])
    {
        $response = $this->request->all($parameters);

        return json_decode($response->getBody(), true);
    }

    /**
     * @param int|string $projectIdOrKey
     * @param \Atlassian\JiraRest\Requests\Project\Parameters\GetParameters|array $parameters
     * @param bool $assoc
     *
     * @return mixed
     */
    public function get($projectIdOrKey, $parameters = [], $assoc = true)
    {
        $response = $this->request->get($projectIdOrKey, $parameters);

        return json_decode($response->getBody(), $assoc);
    }

}