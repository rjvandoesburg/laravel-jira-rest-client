<?php

namespace Atlassian\JiraRest\Helpers\Agile;

use Atlassian\JiraRest\Requests\Agile\Board\BoardRequest;

class Boards
{
    /**
     * @var \Atlassian\JiraRest\Requests\Agile\Board\BoardRequest
     */
    protected $request;

    /**
     * Boards constructor.
     */
    public function __construct()
    {
        $this->request = app(BoardRequest::class);
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Agile\Board\Parameters\GetAllParameters|array $parameters
     * @param bool $assoc
     *
     * @return array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function get($parameters = [], $assoc = true)
    {
        $response = $this->request->all($parameters);

        return json_decode($response->getBody(), $assoc);
    }
}
