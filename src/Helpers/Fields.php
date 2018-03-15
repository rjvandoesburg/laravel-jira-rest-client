<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\Field\FieldRequest;

class Fields
{
    /**
     * @var \Atlassian\JiraRest\Requests\Field\FieldRequest
     */
    protected $request;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->request = app(FieldRequest::class);
    }

    /**
     * Get all custom fields to add to the config
     */
    public function getCustomFields()
    {
        $response = $this->request->get();
        $fields = collect(json_decode($response->getBody(), true))
            ->filter(function ($field) {
                return $field['custom'];
            })->mapWithKeys(function ($field) {
                $key = str_replace('customfield_', '', $field['id']);
                $name = camel_case(str_slug($field['name']));

                return [$key => $name];
            })
            ->toArray();

        return $fields;
    }

}