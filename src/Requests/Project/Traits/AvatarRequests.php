<?php

namespace Atlassian\JiraRest\Requests\Project\Traits;

trait AvatarRequests
{

    /**
     * Update project avatar
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-avatar-put
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function updateAvatar($projectIdOrKey)
    {
        // TODO: Implement update method
    }

    /**
     * Deletes an avatar of a single project. It is only possible to delete custom avatars.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-avatar-id-delete
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function deleteAvatar($projectIdOrKey)
    {
        // TODO: Implement delete method
    }

    /**
     * Creates an avatar for a single project.
     * Use it to upload an image to be be set as a project’s avatar.
     * The uploaded image will be cropped according to the crop parameters defined in the request.
     * If no crop parameters are specified, the image will be cropped to a square.
     * The square will originate at the top left of the image and the length of each side will be set to the smaller of
     * the height or width of the image.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-avatar2-post
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function createAvatar($projectIdOrKey)
    {
        // TODO: Implement create method
    }

    /**
     * Returns all project avatars visible for the currently logged in user.
     * The avatars are grouped into system avatars and custom avatars.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-project-projectIdOrKey-avatars-get
     *
     * @param int|string $projectIdOrKey
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function getAvatar($projectIdOrKey)
    {
        // TODO: Implement get method
    }
}