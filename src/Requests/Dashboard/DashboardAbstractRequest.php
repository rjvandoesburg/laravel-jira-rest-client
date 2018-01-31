<?php

namespace Atlassian\JiraRest\Requests\Dashboard;

use Atlassian\JiraRest\Requests\AbstractRequest;

abstract class DashboardAbstractRequest extends AbstractRequest
{

    public function getResource()
    {
        return 'dashboard';
    }
}