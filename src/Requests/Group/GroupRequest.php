<?php

namespace Atlassian\JiraRest\Requests\Group;

use Atlassian\JiraRest\Requests\AbstractRequest;

class GroupRequest extends AbstractRequest
{
    /**
     * Returns a list of groups whose names contain a query string and, optionally, a user.
     * A list of group names can be provided to exclude groups from the results.
     *
     * The primary use case for this resource is to populate a group picker suggestions list.
     * To this end, the returned object includes the html field where the matched query term is highlighted
     * in the group name with the HTML strong tag. Also, the groups list is wrapped in a response object that contains
     * a header for use in the picker, specifically Showing X of Y matching groups.
     *
     * The list returns with the groups sorted. If no groups match the list criteria, an empty list is returned.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-groups-picker-get
     *
     * @param  \Atlassian\JiraRest\Requests\Group\Parameters\FindParameters|array  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find($parameters)
    {
        return $this->execute('get', 'groups/picker', $parameters);
    }

    /**
     * Returns all users in a group. Users are ordered by username.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-group-member-get
     *
     * @param  \Atlassian\JiraRest\Requests\Group\Parameters\MemberParameters|array  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function member($parameters)
    {
        return $this->execute('get', 'group/member', $parameters);
    }


}