<?php

namespace Atlassian\JiraRest\Requests\Auth\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class LoginParameters
 *
 * @package Atlassian\JiraRest\Requests\Auth\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-auth-1-session-post
 */
class LoginParameters extends AbstractParameters
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;
}