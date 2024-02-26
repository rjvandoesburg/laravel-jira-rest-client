<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\Attachment\AttachmentRequest;

class Attachment
{
    /**
     * @var \Atlassian\JiraRest\Requests\Attachment\AttachmentRequest
     */
    protected $request;

    /**
     * @var int|string
     */
    protected $attachmentId;

    /**
     * Attachment constructor.
     *
     * @param int|string $attachmentId
     */
    public function __construct($attachmentId)
    {
        $this->request = app(AttachmentRequest::class);
        $this->attachmentId = $attachmentId;
    }
    public function content($parameters = [], $assoc = true)
    {
        $response = $this->request->content($this->attachmentId, $parameters);

        return $response->getBody()->getContents();
    }

    public function get($parameters = [], $assoc = true)
    {
        $response = $this->request->get($this->attachmentId, $parameters);

        return json_decode($response->getBody(), $assoc);
    }

}