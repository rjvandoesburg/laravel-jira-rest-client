# Project examples

[All documentation](https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-group-Project)

## Table of Contents

- [Create a project](#create-a-project)
- [Get project paginated](#get-project-paginated)
- [Get all project types](#get-all-project-types)
- [Get project type by key](#get-project-type-by-key)
- [Get accessible project type by key](#get-accessible-project-type-by-key)
- [Get project](#get-project)
- [Update project](#update-project)
- [Delete project](#delete-project)
- [Set project avatar](#set-project-avatar)
- [Delete project avatar](#delete-project-avatar)
- [Load project avatar](#load-project-avatar)
- [Get all project avatars](#get-all-project-avatars)
- [Get project components paginated](#get-project-components-paginated)
- [Get project components](#get-project-components)
- [Get project property keys](#get-project-property-keys)
- [Get project property](#get-project-property)
- [Set project property](#set-project-property)
- [Delete project property](#delete-project-property)
- [Get project roles for project](#get-project-roles-for-project)
- [Get project role for project](#get-project-role-for-project)
- [Set actors for project role](#set-actors-for-project-role)
- [Add actors to project role](#add-actors-to-project-role)
- [Delete actors from project role](#delete-actors-from-project-role)
- [Get project role details](#get-project-role-details)
- [Get all statuses for project](#get-all-statuses-for-project)
- [Update project type](#update-project-type)
- [Get project versions paginated](#get-project-versions-paginated)
- [Get project versions](#get-project-versions)
- [Get project issue security scheme](#get-project-issue-security-scheme)
- [Get project notification scheme](#get-project-notification-scheme)
- [Get assigned permission scheme](#get-assigned-permission-scheme)
- [Assign permission scheme](#assign-permission-scheme)
- [Get project issue security levels](#get-project-issue-security-levels)

## Create a project
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-post_

Creating a new project
```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$parameters = new Project\Parameters\CreateParameters([
    'key'                 => 'EX',
    'name'                => 'Example',
    'projectTypeKey'      => 'business',
    'projectTemplateKey'  => 'com.atlassian.jira-core-project-templates:jira-core-simplified-project-management',
    'description'         => 'Example Project description',
    'leadAccountId'       => 'bd429c95-e27b-4423-a0bd-421cf3d69129',
    'url'                 => 'http://atlassian.com',
    'assigneeType'        => 'PROJECT_LEAD',
    'avatarId'            => 10200,
    'issueSecurityScheme' => 10001,
    'permissionScheme'    => 10011,
    'notificationScheme'  => 10021,
    'categoryId'          => 10120,
]);

$response = $request->create($parameters);

$output = json_decode($response->getBody());
```

## Get project paginated
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-search-get_

Requesting all project with default search parameters
```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->search();

$output = json_decode($response->getBody());
```

Limiting the amount of results using the `SearchParameters`
```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$arameters = new Project\Parameters\SearchParameters([
    'maxResults' => 10
]);

$response = $request->search($arameters);

$output = json_decode($response->getBody());
```

## Get all project types
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-type-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getAllProjectTypes();

$output = json_decode($response->getBody());
```

## Get project type by key
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-type-projectTypeKey-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getProjectType('software');

$output = json_decode($response->getBody());
```

## Get accessible project type by key
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-type-projectTypeKey-accessible-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getAccessibleProjectType('software');

$output = json_decode($response->getBody());
```

## Get project
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->get('EX');

$output = json_decode($response->getBody());
```

Or with parameters
```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$parameters = new Project\Parameters\GetParameters([
    'expand' => 'description,lead',
]);
$response = $request->get('EX', $parameters);

$output = json_decode($response->getBody());
```

## Update project
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-put_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$parameters = new Project\Parameters\UpdateParameters([
    'body' => [
        'key'                 => 'EX',
        'name'                => 'Example',
        'projectTypeKey'      => 'business',
        'projectTemplateKey'  => 'com.atlassian.jira-core-project-templates:jira-core-simplified-project-management',
        'description'         => 'Example Project description',
        'leadAccountId'       => 'bd429c95-e27b-4423-a0bd-421cf3d69129',
        'url'                 => 'http://atlassian.com',
        'assigneeType'        => 'PROJECT_LEAD',
        'avatarId'            => 10200,
        'issueSecurityScheme' => 10001,
        'permissionScheme'    => 10011,
        'notificationScheme'  => 10021,
        'categoryId'          => 10120,
    ]
]);

$response = $request->update('EX', $parameters);

$output = json_decode($response->getBody());
```

## Delete project
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-delete_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->delete('EX');

$output = json_decode($response->getBody());
```

## Set project avatar
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-avatar-put_

Not yet implemented

## Delete project avatar
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-avatar-id-delete_

Not yet implemented

## Load project avatar
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-avatar2-post_

Not yet implemented

## Get all project avatars
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-avatars-get_

Not yet implemented

## Get project components paginated
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-component-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getComponentsPaginated('EX');

$output = json_decode($response->getBody());
```

## Get project components
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-components-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getComponents('EX');

$output = json_decode($response->getBody());
```

## Get project property keys
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-properties-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getPropertyKeys('EX');

$output = json_decode($response->getBody());
```

## Get project property
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-properties-propertyKey-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getProperty('EX', 'projectAccount');

$output = json_decode($response->getBody());
```

## Set project property
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-properties-propertyKey-put_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->setProperty('EX', 'office', 'New-York');

$output = json_decode($response->getBody());
```

## Delete project property
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-properties-propertyKey-delete_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->deleteProperty('EX', 'office');

$output = json_decode($response->getBody());
```

## Get project roles for project
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-role-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getRoles('EX');

$output = json_decode($response->getBody());
```

## Get project role for project
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-role-id-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getRoles('EX');

$output = json_decode($response->getBody());
```

## Set actors for project role
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-role-id-put_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$parameters = new Project\Parameters\SetActorsParameters([
    'categorisedActors' => [
        'atlassian-user-role-actor'  => [
            '2345678-9abc-def1-2345-6789abcdef12',
        ],
        'atlassian-group-role-actor' => [
            'jira-developers',
        ],
    ],
]);

$response = $request->setActors('EX', 10001, $parameters);

$output = json_decode($response->getBody());
```

## Add actors to project role
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-role-id-post_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$parameters = new Project\Parameters\AddActorParameters([
    'group' => [
        'jira-developers',
    ],
]);

$response = $request->addActor('EX', 10001, $parameters);

$output = json_decode($response->getBody());
```

## Delete actors from project role
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-role-id-delete_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$parameters = new Project\Parameters\DeleteActorParameters([
    'group' => [
        'jira-developers',
    ],
]);

$response = $request->deleteActor('EX', 10001, $parameters);

$output = json_decode($response->getBody());
```

## Get project role details
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-roledetails-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getRole('EX', 10001);

$output = json_decode($response->getBody());
```

## Get all statuses for project
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-statuses-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getStatuses('EX');

$output = json_decode($response->getBody());
```

## Update project type
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-type-newProjectTypeKey-put_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->updateProjectType('EX', 'business');

$output = json_decode($response->getBody());
```

## Get project versions paginated
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-version-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getVersionsPaginated('EX');

$output = json_decode($response->getBody());
```

Or with parameters
```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$parameters = new Project\Parameters\VersionsPageinatedParameters([
    'maxResults' => 5,
]);

$response = $request->getVersionsPaginated('EX', $parameters);

$output = json_decode($response->getBody());
```

## Get project versions
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectIdOrKey-versions-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getVersions('EX');

$output = json_decode($response->getBody());
```

## Get project issue security scheme
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectKeyOrId-issuesecuritylevelscheme-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getIssueSecurityScheme('EX');

$output = json_decode($response->getBody());
```

## Get project notification scheme
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectKeyOrId-notificationscheme-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getNotificationScheme('EX');

$output = json_decode($response->getBody());
```

## Get assigned permission scheme
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectKeyOrId-permissionscheme-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getAssignedPermissionScheme('EX');

$output = json_decode($response->getBody());
```

## Assign permission scheme
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectKeyOrId-permissionscheme-put_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->assignPermissionScheme('EX', 10000);

$output = json_decode($response->getBody());
```

## Get project issue security levels
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-project-projectKeyOrId-securitylevel-get_

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->getSecurityLevels('EX');

$output = json_decode($response->getBody());
```