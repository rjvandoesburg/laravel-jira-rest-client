<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\ServerInfoRequest;

class Jira
{
    /**
     * @return \Atlassian\JiraRest\Helpers\Session
     */
    public function session()
    {
        return new Session;
    }

    /**
     * @return \Atlassian\JiraRest\Helpers\Projects
     */
    public function projects()
    {
        return new Projects;
    }

    /**
     * @return \Atlassian\JiraRest\Helpers\Issues
     */
    public function issues()
    {
        return new Issues;
    }

    /**
     * @param int|string $issueIdOrKey
     *
     * @return \Atlassian\JiraRest\Helpers\Issue
     */
    public function issue($issueIdOrKey)
    {
        return new Issue($issueIdOrKey);
    }

    /**
     * @return \Atlassian\JiraRest\Helpers\Fields
     */
    public function fields()
    {
        return new Fields;
    }

    /**
     * @return \Atlassian\JiraRest\Helpers\Agile
     */
    public function agile()
    {
        return new Agile;
    }

    /**
     * @param bool $doHealthCheck
     * @param bool $assoc
     *
     * @return array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function serverInfo($doHealthCheck = false, $assoc = true)
    {
        /** @var \Atlassian\JiraRest\Requests\ServerInfoRequest $request */
        $request = app(ServerInfoRequest::class);

        $response = $request->get($doHealthCheck);

        return json_decode($response->getBody(), $assoc);
    }
}