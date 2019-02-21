# ServerInfo examples

[All documentation](https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-group-ServerInfo)

## Table of Contents

- [Get Jira instance info](#get-Jira-instance-info)

## Get Jira instance info
_Documentation: https://developer.atlassian.com/cloud/jira/platform/rest/v3#api-api-3-serverInfo-get_

```php
<?php
use Atlassian\JiraRest\Requests;

/** @var \Atlassian\JiraRest\Requests\ServerInfoRequest $request */
$request = app(Requests\ServerInfoRequest::class);

$response = $request->get();

$output = json_decode($response->getBody());
```