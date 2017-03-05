<?php

namespace Rjvandoesburg\Jira\Requests\Dashboard;

use Rjvandoesburg\Jira\Requests\BaseRequest;

abstract class DashboardBaseRequest extends BaseRequest
{

    public function getResource()
    {
        return 'dashboard';
    }
}