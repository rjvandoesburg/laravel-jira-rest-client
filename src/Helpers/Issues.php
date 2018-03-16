<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\Issue\IssueRequest;

class Issues
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
        $this->request = app(IssueRequest::class);
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\UpdateOrCreateParameters|array $parameters
     * @param bool $assoc
     *
     * @return bool|array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function create($parameters = [], $assoc = true)
    {
        $response = $this->request->create($parameters);

        if ($response->getStatusCode() !== 201) {
            return false;
        }

        return json_decode($response->getBody(), $assoc);
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\SearchParameters|array $parameters
     * @param bool $assoc
     *
     * @return array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function search($parameters, $assoc = true)
    {
        $response = $this->request->search($parameters);

        return json_decode($response->getBody(), $assoc);
    }

}