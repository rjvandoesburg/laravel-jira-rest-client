<?php

namespace Atlassian\JiraRest\Requests\Attachment;

use Atlassian\JiraRest\Requests\AbstractRequest;

class AttachmentRequest extends AbstractRequest
{
    /**
     * Returns a  representation of the attachment for the given attachment key.
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-issue-attachments
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
        return $this->execute('get', "attachment/content/{$attachmentId}", $parameters ) ;
    }
    public function get($attachmentId, $parameters = [])
    {
        return $this->execute('get', "attachment/{$attachmentId}", $parameters);
    }

}