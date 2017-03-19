<?php

namespace Atlassian\JiraRest\Requests\Dashboard;

class DashboardItemProperties extends DashboardBaseRequest
{
    protected $dashboardId;

    protected $itemId;

    public function __construct($dashboardId, $itemId)
    {
        $this->dashboardId = $dashboardId;
        $this->itemId      = $itemId;
    }

    public function getResource()
    {
        return parent::getResource() . '/' . $this->dashboardId . '/items/' . $this->itemId . '/properties';
    }

}