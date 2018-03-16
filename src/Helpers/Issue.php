<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\Issue\IssueRequest;
use Atlassian\JiraRest\Requests\Issue\Parameters\Transitions\DoTransitionsParameters;

class Issue
{
    /**
     * @var \Atlassian\JiraRest\Requests\Issue\IssueRequest
     */
    protected $request;

    /**
     * @var int|string
     */
    protected $issueIdOrKey;

    /**
     * Issue constructor.
     *
     * @param int|string $issueIdOrKey
     */
    public function __construct($issueIdOrKey)
    {
        $this->request = app(IssueRequest::class);
        $this->issueIdOrKey = $issueIdOrKey;
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\GetParameters|array $parameters
     * @param bool $assoc
     *
     * @return array|\stdClass
     */
    public function get($parameters = [], $assoc = true)
    {
        $response = $this->request->get($this->issueIdOrKey, $parameters);

        return json_decode($response->getBody(), $assoc);
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\EditParameters|array $parameters
     *
     * @return bool
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function edit($parameters = [])
    {
        $response = $this->request->edit($this->issueIdOrKey, $parameters);

        // 204 is returned if the issue was updated successfully.
        return $response->getStatusCode() === 204;
    }

    /**
     * @param bool $deleteSubtasks A true or false value indicating if sub-tasks should be deleted.
     *
     * @return bool
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function delete($deleteSubtasks = false)
    {
        $response = $this->request->delete($this->issueIdOrKey, $deleteSubtasks);

        // 204 is returned if the issue was sucessfully removed.
        return $response->getStatusCode() === 204;
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\Comment\AddParameters|array $parameters
     * @param bool $assoc
     *
     * @return array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function addComment($parameters, $assoc = true)
    {
        $response = $this->request->addComment($this->issueIdOrKey, $parameters);

        return json_decode($response->getBody(), $assoc);
    }

    /**
     * @param int $commentId
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\Comment\UpdateParameters|array $parameters
     * @param string $expand
     * @param bool $assoc
     *
     * @return array|\stdClass
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function updateComment($commentId, $parameters, $expand = '', $assoc = true)
    {
        $response = $this->request->updateComment($this->issueIdOrKey, $commentId, $parameters, $expand);

        return json_decode($response->getBody(), $assoc);
    }

    /**
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\Transitions\GetTransitionsParameters|array
     * @param bool $assoc
     *
     * @return mixed
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function getTransitions($parameters = [], $assoc = true)
    {
        $response = $this->request->getTransitions($this->issueIdOrKey, $parameters);

        return json_decode($response->getBody(), $assoc);
    }

    /**
     * @param int $transition
     * @param \Atlassian\JiraRest\Requests\Issue\Parameters\Transitions\DoTransitionsParameters|array
     *
     * @return bool
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function doTransition($transition, $parameters = [])
    {
        if (is_array($parameters)) {
            $parameters = new DoTransitionsParameters($parameters);
        }

        $parameters->transition['id'] = $transition;

        $response = $this->request->doTransition($this->issueIdOrKey, $parameters);

        // 204 is returned if the transition was done
        return $response->getStatusCode() === 204;
    }


}