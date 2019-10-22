<?php

namespace Atlassian\JiraRest\Requests\Project\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class SearchParameters
 *
 * @package Atlassian\JiraRest\Requests\Project\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-api-3-project-search-get
 *
 * @deprecated Use your own abstraction of \Atlassian\JiraRest\Requests\AbstractParameters or use an array instead
 */
class SearchParameters extends AbstractParameters
{
    /**
     * The index of the first item to return in a page of results (page offset).
     *
     * @var int
     */
    public $startAt = 0;

    /**
     * The maximum number of items to return per page. Max 50.
     *
     * @var int
     */
    public $maxResults = 50;

    /**
     * Order the results by a particular field.
     * If the orderBy field is not set, then projects are listed in ascending order by project key:
     * - category Sorts projects in order by project category.
     *   A complete list of category IDs can be found using the Get all project categories resource.
     * - key Sorts projects in order by project key.
     * - name Sorts projects in alphabetical order by project name.
     * - owner Sorts projects in order by the project lead.
     *
     * @var string
     */
    public $orderBy = 'key';

    /**
     * Filter the results using a literal string. Projects with a matching key or name are returned (case insensitive).
     *
     * @var string
     */
    public $query;

    /**
     * Orders results by the project type.
     * This parameter accepts multiple values separated by a comma.
     * Valid values are:
     * - business
     * - service_desk
     * - software
     *
     * @var string
     */
    public $typeKey;

    /**
     * The ID of the project's category.
     * A complete list of category IDs can be found using the Get all project categories resource.
     *
     * @var int
     */
    public $categoryId;

    /**
     * ilter results by projects for which the calling user has permission to perform the given action.
     * The view action corresponds with the Browse projects project permission, and the edit action corresponds
     *  with Administer project permissions.
     *
     * @var string
     */
    public $action;

    /**
     * Use expand to include additional information in the response.
     * This parameter accepts multiple values separated by a comma:
     * - description Returns the project description.
     * - projectKeys Returns all project keys associated with a project.
     * - lead Returns information about the the project lead.
     * - issueTypes Returns all issue types associated with the project.
     * - url Returns the URL associated with the project.
     *
     * @var string
     */
    public $expand;
}