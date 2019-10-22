<?php

namespace Atlassian\JiraRest\Requests\Group\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class MemberParameters
 *
 * @package Atlassian\JiraRest\Requests\Group\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-api-3-group-member-get
 *
 * @deprecated Use your own abstraction of \Atlassian\JiraRest\Requests\AbstractParameters or use an array instead
 */
class MemberParameters extends AbstractParameters
{

    /**
     * The name of the group.
     * @required
     *
     * @var string
     */
    public $groupname;

    /**
     * Include inactive users.
     *
     * @var bool
     */
    public $includeInactiveUsers = false;

    /**
     * The index of the first user to return.
     *
     * @var int
     */
    public $startAt = 0;

    /**
     * The maximum number of users to return per page.
     *
     * @var int
     */
    public $maxResults = 50;


}