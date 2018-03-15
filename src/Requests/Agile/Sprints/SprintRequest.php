<?php

namespace Atlassian\JiraRest\Requests\Agile\Sprints;

use Atlassian\JiraRest\Requests\Agile\AbstractRequest;

/**
 * Class SprintRequest
 *
 * @package Atlassian\JiraRest\Requests\Agile\Board
 */
class SprintRequest extends AbstractRequest
{

    /**
     * @var string
     */
    protected $resource = 'sprint';

    /**
     * @var null|int
     */
    protected $sprintId = null;

    /**
     * Get the resource to call
     *
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set the resource endpoint of the API
     *
     * @param string $append
     */
    public function setResource($append = '')
    {
        $resource = 'sprint';
        if (! is_null($this->sprintId)) {
            $resource .= "/{$this->sprintId}";
        }

        if (! empty($append)) {
            $resource .= "/{$append}";
        }

        $this->resource = $resource;
    }

    /**
     * @param $sprintId
     *
     * @return $this
     */
    public function setsprintId($sprintId)
    {
        $this->sprintId = $sprintId;
        $this->setResource();

        return $this;
    }

    /**
     * @param $sprintId
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Modules\Jira\Exceptions\JiraClientException
     * @throws \Modules\Jira\Exceptions\JiraNotFoundException
     */
    public function get($sprintId)
    {
        $this->setsprintId($sprintId);

        return $this->execute('get');
    }

}