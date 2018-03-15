<?php

namespace Atlassian\JiraRest\Requests\Agile\Board;

use Atlassian\JiraRest\Requests\Agile\AbstractRequest;
use Atlassian\JiraRest\Requests\Agile\Board\Parameters\AllQuickFiltersParameters;
use Atlassian\JiraRest\Requests\Agile\Board\Parameters\SprintsParameters;
use Atlassian\JiraRest\Requests\Agile\Board\Parameters\CreateParameters;
use Atlassian\JiraRest\Requests\Agile\Board\Parameters\EpicsParameters;
use Atlassian\JiraRest\Requests\Agile\Board\Parameters\GetAllParameters;
use Atlassian\JiraRest\Requests\Agile\Board\Parameters\ProjectsParameters;
use Atlassian\JiraRest\Requests\Agile\Board\Parameters\VersionsParameters;
use Atlassian\JiraRest\Requests\Agile\Parameters\IssuesParameters;

class BoardRequest extends AbstractRequest
{
    /**
     * Returns all boards.
     * This only includes boards that the user has permission to view.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-get
     *
     * @param \Atlassian\JiraRest\Requests\Agile\Board\Parameters\GetAllParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function all($parameters = [])
    {
        $this->validateParameters($parameters, GetAllParameters::class);

        return $this->execute('get', 'board', $parameters);
    }

    /**
     * Creates a new board.
     * Board name, type and filter Id is required.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-post
     *
     * @param \Atlassian\JiraRest\Requests\Agile\Board\Parameters\CreateParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function create($parameters)
    {
        $this->validateParameters($parameters, CreateParameters::class);

        return $this->execute('post', 'board', $parameters);
    }

    /**
     * Returns the board for the given board Id.
     * This board will only be returned if the user has permission to view it.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-get
     *
     * @param int $boardId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function get($boardId)
    {
        return $this->execute('get', "board/{$boardId}");
    }

    /**
     * Deletes the board.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-delete
     *
     * @param int $boardId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function delete($boardId)
    {
        return $this->execute('delete', "board/{$boardId}");
    }

    /**
     * Returns all issues from the board’s backlog, for the given board Id.
     * This only includes issues that the user has permission to view.
     * The backlog contains incomplete issues that are not assigned to any future or active sprint.
     * Note, if the user does not have permission to view the board, no issues will be returned at all.
     * Issues returned from this resource include Agile fields, like sprint, closedSprints, flagged, and epic.
     * By default, the returned issues are ordered by rank.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-backlog-get
     *
     * @param int $boardId
     * @param \Atlassian\JiraRest\Requests\Agile\Parameters\IssuesParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function issuesForBacklog($boardId, $parameters = [])
    {
        $this->validateParameters($parameters, IssuesParameters::class);

        return $this->execute('get', "board/{$boardId}/backlog", $parameters);
    }

    /**
     * Get the board configuration.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-configuration-get
     *
     * @param int $boardId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function configuration($boardId)
    {
        return $this->execute('get', "board/{$boardId}/configuration");
    }

    /**
     * Returns all epics from the board, for the given board Id.
     * This only includes epics that the user has permission to view.
     * Note, if the user does not have permission to view the board, no epics will be returned at all.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-epic-get
     *
     * @param int $boardId
     * @param \Atlassian\JiraRest\Requests\Agile\Board\Parameters\EpicsParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function epics($boardId, $parameters = [])
    {
        $this->validateParameters($parameters, EpicsParameters::class);

        return $this->execute('get', "board/{$boardId}/epic");
    }

    /**
     * Returns all issues that belong to an epic on the board, for the given epic Id and the board Id.
     * This only includes issues that the user has permission to view.
     * Issues returned from this resource include Agile fields, like sprint, closedSprints, flagged, and epic.
     * By default, the returned issues are ordered by rank.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-epic-epicId-issue-get
     *
     * @param int $boardId
     * @param int $epicId
     * @param \Atlassian\JiraRest\Requests\Agile\Parameters\IssuesParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function issuesForEpic($boardId, $epicId, $parameters = [])
    {
        $this->validateParameters($parameters, IssuesParameters::class);

        return $this->execute('get', "board/{$boardId}/epic/{$epicId}/issue", $parameters);
    }

    /**
     * Returns all issues that do not belong to any epic on a board, for a given board Id.
     * This only includes issues that the user has permission to view.
     * Issues returned from this resource include Agile fields, like sprint, closedSprints, flagged, and epic.
     * By default, the returned issues are ordered by rank.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-epic-none-issue-get
     *
     * @param int $boardId
     * @param \Atlassian\JiraRest\Requests\Agile\Parameters\IssuesParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function issuesWithoutEpic($boardId, $parameters = [])
    {
        return $this->issuesForEpic($boardId, 'none', $parameters);
    }

    /**
     * Returns all issues from a board, for a given board Id.
     * This only includes issues that the user has permission to view.
     * An issue belongs to the board if its status is mapped to the board’s column.
     * Epic issues do not belongs to the scrum boards.
     * Note, if the user does not have permission to view the board, no issues will be returned at all.
     * Issues returned from this resource include Agile fields, like sprint, closedSprints, flagged, and epic.
     * By default, the returned issues are ordered by rank.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-issue-get
     *
     * @param int $boardId
     * @param \Atlassian\JiraRest\Requests\Agile\Parameters\IssuesParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function issues($boardId, $parameters = [])
    {
        $this->validateParameters($parameters, IssuesParameters::class);

        return $this->execute('get', "board/{$boardId}/issue", $parameters);
    }

    /**
     * Returns all projects that are associated with the board, for the given board Id.
     * If the user does not have permission to view the board, no projects will be returned at all.
     * Returned projects are ordered by the name.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-project-get
     *
     * @param int $boardId
     * @param \Atlassian\JiraRest\Requests\Agile\Board\Parameters\ProjectsParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function projects($boardId, $parameters = [])
    {
        $this->validateParameters($parameters, ProjectsParameters::class);

        return $this->execute('get', "board/{$boardId}/project", $parameters);
    }

    /**
     * Returns all projects that are statically associated with the board, for the given board Id.
     * Returned projects are ordered by the name.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-project-full-get
     *
     * @param int $boardId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function projectsFull($boardId)
    {
        return $this->execute('get', "board/{$boardId}/project/full");
    }

    /**
     * Returns the keys of all properties for the board identified by the id.
     * The user who retrieves the property keys is required to have permissions to view the board.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-properties-get
     *
     * @param int $boardId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function properties($boardId)
    {
        return $this->execute('get', "board/{$boardId}/properties");
    }

    /**
     * Returns the value of the property with a given key from the board identified by the provided id.
     * The user who retrieves the property is required to have permissions to view the board.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-properties-propertyKey-get
     *
     * @param int $boardId
     * @param string $propertyKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getProperty($boardId, $propertyKey)
    {
        return $this->execute('get', "board/{$boardId}/properties/{$propertyKey}");
    }

    /**
     * Sets the value of the specified board’s property.
     *
     * You can use this resource to store a custom data against the board identified by the id.
     * The user who stores the data is required to have permissions to modify the board.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-properties-propertyKey-put
     *
     * @param int $boardId
     * @param string $propertyKey
     * @param string $value
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function setProperty($boardId, $propertyKey, $value)
    {
        return $this->execute('put', "board/{$boardId}/properties/{$propertyKey}", $value);
    }

    /**
     * Removes the property from the board identified by the id.
     * The user removing the property is required to have permissions to modify the board.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-properties-propertyKey-delete
     *
     * @param int $boardId
     * @param string $propertyKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function deleteProperty($boardId, $propertyKey)
    {
        return $this->execute('delete', "board/{$boardId}/properties/{$propertyKey}");
    }

    /**
     * Returns all quick filters from a board, for a given board Id.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-quickfilter-get
     *
     * @param int $boardId
     * @param \Atlassian\JiraRest\Requests\Agile\Board\Parameters\AllQuickFiltersParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function allQuickFilters($boardId, $parameters = [])
    {
         $this->validateParameters($parameters, AllQuickFiltersParameters::class);

        return $this->execute('get', "board/{$boardId}/quickfilter", $parameters);
    }

    /**
     * Returns the quick filter for a given quick filter Id.
     * The quick filter will only be returned if the user can view the board that the quick filter belongs to.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-quickfilter-quickFilterId-get
     *
     * @param int $boardId
     * @param int $quickFilterId
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     */
    public function getQuickFilter($boardId, $quickFilterId)
    {
        return $this->execute('get', "board/{$boardId}/quickfilter/{$quickFilterId}");
    }

    /**
     * Returns all sprints from a board, for a given board Id. This only includes sprints that the user has permission to view.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-sprint-get
     *
     * @param int $boardId
     * @param \Atlassian\JiraRest\Requests\Agile\Board\Parameters\SprintsParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function sprints($boardId, $parameters = [])
    {
         $this->validateParameters($parameters, SprintsParameters::class);

        return $this->execute('get', "board/{$boardId}/sprint", $parameters);
    }

    /**
     * Get all issues you have access to that belong to the sprint from the board.
     * Issue returned from this resource contains additional fields like: sprint, closedSprints, flagged and epic.
     * Issues are returned ordered by rank.
     * JQL order has higher priority than default rank.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-sprint-sprintId-issue-get
     *
     * @param int $boardId
     * @param int $sprintId
     * @param \Atlassian\JiraRest\Requests\Agile\Parameters\IssuesParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function issuesForSprint($boardId, $sprintId, $parameters = [])
    {
         $this->validateParameters($parameters, IssuesParameters::class);

        return $this->execute('get', "board/{$boardId}/sprint/{$sprintId}/issue");
    }

    /**
     * Returns all versions from a board, for a given board Id. This only includes versions that the user has permission to view.
     *
     * Note, if the user does not have permission to view the board, no versions will be returned at all.
     * Returned versions are ordered by the name of the project from which they belong and then by sequence defined by user.
     *
     * @see https://developer.atlassian.com/cloud/jira/software/rest/#api-board-boardId-version-get
     *
     * @param int $boardId
     * @param \Atlassian\JiraRest\Requests\Agile\Board\Parameters\VersionsParameters|array $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function versions($boardId, $parameters = [])
    {
        $this->validateParameters($parameters, VersionsParameters::class);

        return $this->execute('get', "board/{$boardId}/version", $parameters);
    }
}
