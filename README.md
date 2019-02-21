# Jira API client for Laravel 5.4+

Perform various operations of [Jira APIs](https://developer.atlassian.com/cloud/jira/platform/rest/) with Laravel 5.4+

The aim of the package is to make it easier to communicate with the API. By default the response from the request is not altered in any way.
By creating your own implementation or by using the simple helpers provided with the package you are able to integrate Jira the way you like.

## Installation

To get the latest version of `laravel-jira-rest-client`, run the following command
```shell
composer require rjvandoesburg/laravel-jira-rest-client
```
Do note that not all methods have been implemented yet.

Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

## Laravel 5.4:

If you don't use auto-discovery, add the ServiceProvider to the providers array in `config/app.php`
```php
'providers' => [
    // ...

    Atlassian\JiraRest\JiraRestServiceProvider::class,
],
```

Also locate the `Aliases` key in your `config/app.php` file and register the Facade:

```php
'aliases' => [
    // ...

    'Jira' => Atlassian\JiraRest\Facades\Jira::class,
],
```
Copy the package config to your local config with the publish command:
```shell
php artisan vendor:publish --provider="Atlassian\JiraRest\JiraRestServiceProvider"
```

Update the .env with your proper credentials using JIRA variables from `config/atlassian/jira.php`.

## Usage

The core of this package is a direct reflection of the Jira API mean that all request classes don't format the response you get from the API.
This desicion was made so the package is more versitile allowing users to handle the response of the requests to their own wishes. 

For example, to fetch a specific issue you could do the following
```php
$request = new \Atlassian\JiraRest\Requests\Issue\IssueRequest;
$response = $request->get('ISSUE-3');
```

All responses are an instance of `\GuzzleHttp\Psr7\Response` [Read more](http://docs.guzzlephp.org/en/stable/psr7.html) so in order to get the json response you could do the following:
```php
$response = json_decode($response->getBody(), true);
``` 
Which will return a response like seen in the [API](https://developer.atlassian.com/cloud/jira/platform/rest/#api-api-2-issue-issueIdOrKey-get)

###Parameters
Most request have additional parameters like `maxResults` and `startAt` or `query`.

Within the package I try to create a parameter class for every request that has multiple.

For example:

Requesting projects with fewer results
```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$parameters = new Project\Parameters\SearchParameters;
$parameters->maxResults = 10;
$parameters->startAt = 0;

$response = $request->search($parameters);

$output = json_decode($response->getBody());
```

Using it like this you can manipulate the default search parameters.

But other ways of using the parameters are as followed:

```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$parameters = new Project\Parameters\SearchParameters([
    'maxResults' => 10,
    'startAt' => 0
]);

$response = $request->search($parameters);

$output = json_decode($response->getBody());
```

Or as an array directly in the request.
```php
<?php
use Atlassian\JiraRest\Requests\Project;

/** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
$request = app(Project\ProjectRequest::class);

$response = $request->search([
    'maxResults' => 10,
    'startAt' => 0
]);

$output = json_decode($response->getBody());
```

### Helpers (deprecated)
Now because for the most part you don't want to spend time writing the requests yourself there are some useful helpers to get you communicating with the api.

To fetch a single issue you can use the following code:
```php
$issue = jira()->issue('ISSUE-3')->get();
```

Or use the facade if you prefer:
```php
$issue = \Jira::issue('ISSUE-3')->get();
```

_deprecating most helpers because writing helpers for all classes is too much maintenance_

### Middleware
To alter the Guzzle Client used for requests you can add middleware to alter the options. To add new middleware you need to alter `config/atlassian/jira.php` and add the class to the `client_options` array.

#### Basic Auth
```php
'client_options' => [
    'auth' => \Atlassian\JiraRest\Requests\Middleware\BasicAuthMiddleware::class,
],
```
By default the `BasicAuthMiddleware` is added and used for authentication with Jira. (Sessions are WIP)

#### OAuth 1.0
```php
'client_options' => [
    'auth' => \Atlassian\JiraRest\Requests\Middleware\OAuthMiddleware::class,
],

```
**Impersonation**

To impersonate a user through Jira requests you must set `JIRA_IMPERSONATE=true` in your .env file. 

Once impersonation is enabled, Laravel will use the authentificated users' `name` by default. 
However, it's also possible to impersonate a user manually by sending a user's name to constructor of the middleware. To do this you would need to manually register the middleware and pass the user.


**JIRA Setup for Impersonation**
1. Follow [Jira documentation](https://developer.atlassian.com/server/jira/platform/oauth/#see-it-in-action) to generate an RSA public/private key pair.
2. Go to Jira --> Application Links (Admin)
3. Create a new link with your server url 
4. Ignore the "No response" warning
5. Enter anything in all the field and keep "Create incoming link unchecked". Jira has a weird behaviour when it comes to setting up app links. If you create your incoming link now, you won't have access to 2-Legged auth (Impersonation).
6. Click continue (ignore the warning). This should have created your new app link.
7. Edit that link (notice there are no Outgoing info even if you added dummy info at creation).
8. You may now enter all the info for OAuth and setup impersonation (Allow 2-Legged OAuth). 

## TODO
- Implement missing requests
- Middleware
- Better README
- Sessions auth
- A way to alter the request before it is send out (globally for each request and possibility for specific requests)
- Tests
