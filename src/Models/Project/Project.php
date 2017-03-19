<?php

namespace Atlassian\JiraRest\Models\Project;

use Atlassian\JiraRest\Models\Issue\Issue;
use Atlassian\JiraRest\Models\JiraEloquentModel;

class Project extends JiraEloquentModel
{

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'key';

    protected $fillable = [
        'key',
        'name',
        'projectTypeKey',
        'projectTemplateKey',
        'description',
        'lead',
        'url',
        'assigneeType',
        'avatarId',
        'issueSecurityScheme',
        'permissionScheme',
        'notificationScheme',
        'categoryId',
    ];

    public function issues()
    {
        return $this->hasMany(Issue::class, 'project');
    }

    public function avatar()
    {
        
    }

}