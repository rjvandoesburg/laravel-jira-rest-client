<?php

namespace Atlassian\JiraRest\Helpers;

use Atlassian\JiraRest\Requests\Field\FieldRequest;
use Illuminate\Support\Str;

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
        $fields = collect(\json_decode($response->getBody(), true))
            ->filter(static function ($field) {
                return $field['custom'];
            })->mapWithKeys(static function ($field) {
                $key = \str_replace('customfield_', '', $field['id']);
                $name = Str::camel(Str::slug($field['name']));

                return [$key => $name];
            })
            ->toArray();

        return $fields;
    }

}