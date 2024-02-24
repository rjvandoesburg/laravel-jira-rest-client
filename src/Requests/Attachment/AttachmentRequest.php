<?php

namespace Atlassian\JiraRest\Requests\Attachment;

use Atlassian\JiraRest\Requests\AbstractRequest;

class AttachmentRequest extends AbstractRequest
{
    /**
     * Returns a full representation of the issue for the given issue key.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/#api-rest-api-3-issue-issueIdOrKey-get
     *
     * @param  string|int  $attachmentId
     * @param  array|\Illuminate\Contracts\Support\Arrayable  $parameters
     *
     * @return \GuzzleHttp\Psr7\Response
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function content($attachmentId, $parameters = [])
    {
        return $this->execute('get', "attachment/content/{$attachmentId}", $parameters , false , [] ) ;
    }
    public function get($attachmentId, $parameters = [])
    {
        return $this->execute('get', "attachment/{$attachmentId}", $parameters);
    }

}