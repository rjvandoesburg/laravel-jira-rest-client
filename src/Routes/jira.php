<?php

Route::get('atlassian/jira/oauth/access', 'OAuthController@requestToken')
    ->name('atlassian.jira.oauth.access');

Route::get('atlassian/jira/oauth/callback', 'OAuthController@callback')
    ->name('atlassian.jira.oauth.callback');