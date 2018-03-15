<?php

namespace Atlassian\JiraRest\Requests\Agile\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

class IssuesParameters extends AbstractParameters
{
    /**
     * This parameter is currently not used.
     *
     * @var string
     */
    public $expand;

    /**
     * The list of fields to return for each issue. By default, all navigable and Agile fields are returned.
     *
     * @var string
     */
    public $fields;

    /**
     * Filters results using a JQL query. If you define an order in your JQL query, it will override the default order of the returned issues.
     *
     * @var string
     */
    public $jql;

    /**
     * The maximum number of boards to return per page.
     *
     * @var int
     */
    public $maxResults = 100;

    /**
     * The starting index of the returned boards. Base index: 0.
     *
     * @var int
     */
    public $startAt = 0;

    /**
     * Specifies whether to validate the JQL query or not.
     *
     * @var bool
     */
    public $validateQuery = false;
}
