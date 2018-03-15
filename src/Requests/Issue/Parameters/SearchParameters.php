<?php

namespace Atlassian\JiraRest\Requests\Issue\Parameters;

use Atlassian\JiraRest\Requests\AbstractParameters;

/**
 * Class SearchParameters
 *
 * @package Atlassian\JiraRest\Requests\Issue\Parameters
 * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-search-get
 */
class SearchParameters extends AbstractParameters
{
    /**
     * This parameter is currently not used.
     *
     * @var string
     */
    public $expand;

    /**
     * The list of fields to return for each issue.
     * By default, all navigable and Agile fields are returned.
     *
     * @var string
     */
    public $fields;

    /**
     * If true then issue fields are referenced by keys instead of IDs.
     *
     * @var bool
     */
    public $fielsByKeys;

    /**
     * Filters results using a JQL query. If you define an order in your JQL query, it will override the default order of the returned issues.
     *
     * @var string
     */
    public $jql;

    /**
     * The maximum number of issues to return (defaults to 50).
     *
     * @var int
     */
    public $maxResults = 50;

    /**
     * The list of properties to return for each issue. By default no properties are returned.
     * @var string
     */
    public $properties;

    /**
     * The starting index of the returned boards. Base index: 0.
     *
     * @var int
     */
    public $startAt = 0;

    /**
     * Whether to validate the JQL query and how strictly to treat the validation results.
     * Supported values:
     *  “strict”,
     *  “warn”,
     *  “none”
     * legacy synonyms
     *  “true”
     *  “false”
     *
     * @var bool
     */
    public $validateQuery;
}