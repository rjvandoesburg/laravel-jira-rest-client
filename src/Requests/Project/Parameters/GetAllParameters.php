<?php

namespace Atlassian\JiraRest\Requests\Project\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class GetAllParameters
 *
 * @package Atlassian\JiraRest\Requests\Project\Parameters
 * @see https://developers.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-get
 */
class GetAllParameters extends AbstractParameters
{
    /**
     * Multi-value parameter defining request properties to expand in the response.
     *
     * @var string
     */
    public $expand;

    /**
     * Only projects recently accessed by the current user will be returned if this parameter is set.
     * If no user is logged in, recently accessed projects will be returned based on current HTTP session.
     * Maximum count is limited to the specified number, but no more than 20.
     *
     * @var int
     */
    public $recent;
}