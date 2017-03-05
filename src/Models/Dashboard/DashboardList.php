<?php

namespace Rjvandoesburg\Jira\Models\Dashboard;

use Rjvandoesburg\Jira\Models\JiraModel;

class DashboardList extends JiraModel
{

    public function setDashboardsAttribute($dashboards)
    {
        $collection = collect();
        foreach ($dashboards as $dashboard) {
            $collection->push(new Dashboard($dashboard));
        }
        $this->attributes['dashboards'] = $collection;
    }
}