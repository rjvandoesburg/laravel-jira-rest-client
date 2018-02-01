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
     * @param array $parameters
     *
     * @return bool|array
     */
    public function create($parameters = [])
    {
        $response = $this->request->create($parameters);

        if ($response->getStatusCode() !== 201) {
            return false;
        }

        return json_decode($response->getBody(), true);
    }

    /**
     * @param $issueIdOrKey
     *
     * @return array
     */
    public function get($issueIdOrKey)
    {
        $response = $this->request->get($issueIdOrKey);

        return json_decode($response->getBody(), true);
    }

    /**
     * @param int|string $issueIdOrKey
     * @param array $parameters
     *
     * @return bool
     */
    public function edit($issueIdOrKey, $parameters = [])
    {
        $response = $this->request->edit($issueIdOrKey, $parameters);

        // 204 is returned if the issue was updated successfully.
        return $response->getStatusCode() === 204;
    }

    /**
     * @param $issueIdOrKey
     *
     * @return bool
     */
    public function delete($issueIdOrKey)
    {
        $response = $this->request->get($issueIdOrKey);

        // 204 is returned if the issue was sucessfully removed.
        return $response->getStatusCode() === 204;
    }

    /**
     * @param $parameters
     *
     * @return string
     */
    public function search($parameters)
    {
        $response = $this->request->search($parameters);

        return json_decode($response->getBody(), true);
    }

}