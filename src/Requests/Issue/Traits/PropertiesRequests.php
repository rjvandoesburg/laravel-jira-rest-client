<?php

namespace Atlassian\JiraRest\Requests\Issue\Traits;

/**
 * Trait Properties
 *
 * @package Atlassian\JiraRest\Requests\Issue
 */
trait PropertiesRequests
{
    /**
     * Returns the keys of all properties for the issue identified by the key or by the id.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-properties-get
     *
     * @param string|int $issueIdOrKey
     */
    public function getPropertyKeys($issueIdOrKey)
    {
        // TODO: implement
    }

    /**
     * Returns the value of the property with a given key from the issue identified by the key or by the id.
     * The user who retrieves the property is required to have permissions to read the issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-properties-propertyKey-get
     *
     * @param string|int $issueIdOrKey
     * @param string $propertyKey
     */
    public function getProperty($issueIdOrKey, $propertyKey)
    {
        // TODO: implement
    }

    /**
     * Sets the value of the specified issue’s property.
     * You can use this resource to store a custom data against the issue identified by the key or by the id.
     * The user who stores the data is required to have permissions to edit the issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-properties-propertyKey-put
     *
     * @param string|int $issueIdOrKey
     * @param string $propertyKey
     */
    public function setProperty($issueIdOrKey, $propertyKey)
    {
        // TODO: implement
    }

    /**
     * Removes the property from the issue identified by the key or by the id.
     * The user removing the property is required to have permissions to edit the issue.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-properties-propertyKey-delete
     *
     * @param string|int $issueIdOrKey
     * @param string $propertyKey
     */
    public function deleteProperty($issueIdOrKey, $propertyKey)
    {
        // TODO: implement
    }
}