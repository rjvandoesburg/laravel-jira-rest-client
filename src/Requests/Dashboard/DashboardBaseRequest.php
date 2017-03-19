<?php

namespace Atlassian\JiraRest\Requests\Dashboard;

use Atlassian\JiraRest\Requests\BaseRequest;

abstract class DashboardBaseRequest extends BaseRequest
{

    public function getResource()
    {
        return 'dashboard';
    }
}