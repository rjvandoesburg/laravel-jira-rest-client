<?php

namespace Atlassian\JiraRest\Requests\User\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class GetParameters
 *
 * @package Atlassian\JiraRest\Requests\User\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-user-get
 */
class GetParameters extends AbstractParameters
{
    /**
     * User key
     *
     * @var string
     */
    public $key;

    /**
     * The username
     *
     * @var string
     */
    public $username;

    /**
     * The resource accepts the expand param that is used to include, hidden by default, parts of response.
     * This can be used to include:
     * - groups - all groups, including nested groups, to which user belongs
     * - applicationRoles - application roles defines to which application user has access
     *
     * @var string
     */
    public $expand;
}