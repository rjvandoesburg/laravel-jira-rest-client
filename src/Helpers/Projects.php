<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\Project\ProjectRequest;

class Projects
{
    /**
     * @var \Atlassian\JiraRest\Requests\Issue\IssueRequest
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
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function all()
    {
        $response = $this->request->all();

        return json_decode($response->getBody(), true);
    }

    /**
     * @param int|string $projectIdOrKey
     *
     * @return mixed
     */
    public function get($projectIdOrKey)
    {
        $response = $this->request->get($projectIdOrKey);

        return json_decode($response->getBody(), true);
    }

}