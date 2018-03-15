<?php

namespace Atlassian\JiraRest\Requests\Agile\Sprint;

use Atlassian\JiraRest\Requests\Agile\AbstractRequest;
use Atlassian\JiraRest\Requests\Agile\Parameters\IssuesParameters;
use Atlassian\JiraRest\Requests\Agile\Sprint\Parameters\CreateParameters;
use Atlassian\JiraRest\Requests\Agile\Sprint\Parameters\UpdateParameters;

/**
 * Class SprintRequest
 *
 * @package Atlassian\JiraRest\Requests\Agile\Board
 */
class SprintRequest extends AbstractRequest
{
    /**
     * Creates a future sprint. Sprint name and origin board id are required.
     * Start date, end date, and goal are optional.
     *
     * Note, the sprint name is trimmed.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-post
     *
     * @param \Atlassian\JiraRest\Requests\Agile\Sprint\Parameters\CreateParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function create($parameters = [])
    {
        $this->validateParameters($parameters, CreateParameters::class);

        return $this->execute('post', 'sprint', $parameters);
    }

    /**
     * Returns the sprint for a given sprint Id.
     * The sprint will only be returned if the user can view the board that the sprint was created on, or view at least one of the issues in the sprint.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-get
     *
     * @param int $sprintId The Id of the requested sprint.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function get($sprintId)
    {
        return $this->execute('get', "sprint/{$sprintId}");
    }

    /**
     * Performs a partial update of a sprint.
     * A partial update means that fields not present in the request JSON will not be updated.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-post
     *
     * @param int $sprintId The Id of the sprint to update.
     * @param \Atlassian\JiraRest\Requests\Agile\Sprint\Parameters\UpdateParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function partialUpdate($sprintId, $parameters = [])
    {
        $this->validateParameters($parameters, UpdateParameters::class);

        return $this->execute('post', "sprint/{$sprintId}", $parameters);
    }

    /**
     * Performs a full update of a sprint.
     * A full update means that the result will be exactly the same as the request body.
     * Any fields not present in the request JSON will be set to null.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-put
     *
     * @param int $sprintId The Id of the sprint to update.
     * @param \Atlassian\JiraRest\Requests\Agile\Sprint\Parameters\|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function update($sprintId, $parameters = [])
    {
        $this->validateParameters($parameters, UpdateParameters::class);

        return $this->execute('put', "sprint/{$sprintId}", $parameters);
    }

    /**
     * Deletes a sprint.
     * Once a sprint is deleted, all open issues in the sprint will be moved to the backlog.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-delete
     *
     * @param int $sprintId The Id of the sprint to delete.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function delete($sprintId)
    {
        return $this->execute('delete', "sprint/{$sprintId}");
    }

    /**
     * Returns all issues in a sprint, for a given sprint Id.
     * This only includes issues that the user has permission to view.
     *
     * By default, the returned issues are ordered by rank.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-issue-get
     *
     * @param int $sprintId The Id of the sprint that contains the requested issues.
     * @param \Atlassian\JiraRest\Requests\Agile\Parameters\IssuesParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function issues($sprintId, $parameters = [])
    {
        $this->validateParameters($parameters, IssuesParameters::class);

        return $this->execute('get', "sprint/{$sprintId}/issue", $parameters);
    }

    /**
     * Moves issues to a sprint, for a given sprint Id. Issues can only be moved to open or active sprints.
     * The maximum number of issues that can be moved in one operation is 50.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-issue-post
     *
     * @param int $sprintId The Id of the sprint that you want to assign issues to.
     * @param array $issues A list of issues, both id and key are accepted.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function moveIssues($sprintId, array $issues = [])
    {
        return $this->execute('post', "sprint/{$sprintId}/issue", ['issues' => $issues]);
    }

    /**
     * Returns the keys of all properties for the sprint identified by the id.
     * The user who retrieves the property keys is required to have permissions to view the sprint.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-properties-get
     *
     * @param int $sprintId The id of the sprint from which property keys will be returned.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function properties($sprintId)
    {
        return $this->execute('get', "sprint/{$sprintId}/properties");
    }

    /**
     * Returns the value of the property with a given key from the sprint identified by the provided id.
     * The user who retrieves the property is required to have permissions to view the sprint.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-properties-propertyKey-get
     *
     * @param int $sprintId The id of the sprint from which the property will be returned.
     * @param string $propertyKey The key of the property to return.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getProperty($sprintId, $propertyKey)
    {
        return $this->execute('get', "sprint/{$sprintId}/properties/{$propertyKey}");
    }

    /**
     * Sets the value of the specified sprint’s property.
     *
     * You can use this resource to store a custom data against the sprint identified by the id.
     * The user who stores the data is required to have permissions to modify the sprint.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-properties-propertyKey-put
     *
     * @param int $sprintId The id of the sprint on which the property will be set.
     * @param string $propertyKey The key of the sprint’s property. The maximum length of the key is 255 bytes.
     * @param string $value
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function setProperty($sprintId, $propertyKey, $value)
    {
        return $this->execute('put', "sprint/{$sprintId}/properties/{$propertyKey}", $value);
    }

    /**
     * Removes the property from the sprint identified by the id.
     * The user removing the property is required to have permissions to modify the sprint.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-properties-propertyKey-delete
     *
     * @param int $sprintId The id of the sprint from which the property will be removed.
     * @param string $propertyKey The key of the property to remove.
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function deleteProperty($sprintId, $propertyKey)
    {
        return $this->execute('delete', "sprint/{$sprintId}/properties/{$propertyKey}");
    }

    /**
     * Swap the position of the sprint with the second sprint.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-sprint-sprintId-swap-post
     *
     * @param int $sprintId The Id of the sprint to swap.
     * @param int $sprintToSwapWith
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function swap($sprintId, $sprintToSwapWith)
    {
        return $this->execute('get', "sprint/{$sprintId}", ['sprintToSwapWith' => $sprintToSwapWith]);
    }
}
