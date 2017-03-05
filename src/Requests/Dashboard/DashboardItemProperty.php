<?php

namespace Rjvandoesburg\Jira\Requests\Dashboard;

class DashboardItemProperty extends DashboardBaseRequest
{
    protected $dashboardId;

    protected $itemId;

    protected $propertyId;

    public function __construct($dashboardId, $itemId, $propertyId)
    {
        $this->dashboardId = $dashboardId;
        $this->itemId      = $itemId;
        $this->propertyId  = $propertyId;
    }

    public function getResource()
    {
        return parent::getResource() . '/' . $this->dashboardId . '/items/' . $this->itemId . '/properties/' . $this->propertyId;
    }


    public function getAvailableResources()
    {
        return [
            'get',
            'put',
            'delete'
        ];
    }

}