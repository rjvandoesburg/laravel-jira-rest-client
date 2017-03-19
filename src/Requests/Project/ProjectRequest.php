<?php

namespace Atlassian\JiraRest\Requests\Project;

use Atlassian\JiraRest\Models\Project\Project;

class ProjectRequest extends ProjectBaseRequest
{

    protected $project = null;

    protected $options = [
        'get' => [
            'expand',
            'recent'
        ]
    ];

    public function __construct($project = null)
    {
        $this->project = $project;
    }

    public function getResource()
    {
        if (! is_null($id = $this->project)) {
            return parent::getResource() . '/' . $id;
        }

        return parent::getResource();
    }

    public function handleResponse($response)
    {
        $response = json_decode($response);

        if ($this->project === null) {
            $collection = collect();
            foreach ($response as $project) {
                $collection->push(Project::fromJira($project));
            }

            return $collection;
        }

        return Project::fromJira($response);
    }

}