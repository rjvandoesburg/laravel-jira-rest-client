<?php

namespace Atlassian\JiraRest\Requests\Dashboard;

use Atlassian\JiraRest\Models\Dashboard\DashboardList;
use Atlassian\JiraRest\Models\Dashboard\Dashboard as DashboardResponse;

class Dashboard extends DashboardBaseRequest
{
    protected $dashboardId = null;

    protected $options = [
        'get' => [
            'filter',
            'startAt',
            'maxResults'
        ]
    ];

    /**
     * Dashboard constructor.
     *
     * @param null $dashboardId
     */
    public function __construct($dashboardId = null)
    {
        $this->dashboardId = $dashboardId;
    }

    public function getResource()
    {
        if (! is_null($id = $this->dashboardId)) {
            return parent::getResource() . '/' . $id;
        }

        return parent::getResource();
    }

    public function handleResponse($response)
    {
        $response = json_decode($response);

        if ($this->dashboardId === null) {
            return new DashboardList($response);
        }

        return new DashboardResponse($response);
    }
}