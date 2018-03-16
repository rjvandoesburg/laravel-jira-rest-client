<?php

namespace Atlassian\JiraRest\Helpers\Agile;

use Atlassian\JiraRest\Requests\Agile\Board\BoardRequest;

class Board
{

    /**
     * @var int
     */
    protected $boardId;

    /**
     * @var \Atlassian\JiraRest\Requests\Agile\Board\BoardRequest
     */
    protected $request;

    /**
     * Board constructor.
     *
     * @param $boardId
     */
    public function __construct($boardId)
    {
        $this->boardId = $boardId;
        $this->request = app(BoardRequest::class);
    }

    /**
     * @param bool $assoc
     *
     * @return array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function get($assoc = true)
    {
        $response = $this->request->get($this->boardId);

        return json_decode($response->getBody(), $assoc);
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Agile\Board\Parameters\ProjectsParameters|array $parameters
     * @param bool $assoc
     *
     * @return array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function projects($parameters = [], $assoc = true)
    {
        $response = $this->request->projects($this->boardId, $parameters);

        return json_decode($response->getBody(), $assoc);
    }

    /**
     * @param bool $assoc
     *
     * @return array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function configuration($assoc = true)
    {
        $response = $this->request->configuration($this->boardId);

        return json_decode($response->getBody(), $assoc);
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Agile\Board\Parameters\SprintsParameters|array $parameters
     * @param bool $assoc
     *
     * @return array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function sprints($parameters = [], $assoc = true)
    {
        $response = $this->request->sprints($this->boardId, $parameters);

        return json_decode($response->getBody(), $assoc);
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Agile\Parameters\IssuesParameters|array $parameters
     * @param bool $assoc
     *
     * @return array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function issues($parameters = [], $assoc = true)
    {
        $response = $this->request->issues($this->boardId, $parameters);

        return json_decode($response->getBody(), $assoc);
    }
}
