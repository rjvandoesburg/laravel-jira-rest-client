<?php

namespace Atlassian\JiraRest\Http\Controllers;

use Atlassian\JiraRest\Events\OAuth\AccessTokensReceived;
use Atlassian\JiraRest\Events\OAuth\RequestTokensReceived;
use Atlassian\JiraRest\JiraRestServiceProvider;
use Atlassian\JiraRest\Requests\Auth\OAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

/**
 * Class OAuthController
 *
 * @package Atlassian\JiraRest\Requests\Auth\OAuth
 * @see https://developer.atlassian.com/server/jira/platform/oauth/
 */
class OAuthController extends \Illuminate\Routing\Controller
{
    /**
     * Request access from Jira
     *
     * @param \Illuminate\Http\Request $request
     * @param \Atlassian\JiraRest\Requests\Auth\OAuthRequest $oauthRequest
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function requestToken(Request $request, OAuthRequest $oauthRequest)
    {
        $request->session()->flash(JiraRestServiceProvider::CONFIG_KEY.'.oauth.initial-request', true);
        $request->session()->flash(JiraRestServiceProvider::CONFIG_KEY.'.oauth.redirect', $request->get('redirect_url', URL::previous()));
        // Application -> Jira - Request request token
        $requestTokenRequest = $oauthRequest->getRequestToken(route('atlassian.jira.oauth.callback'));
        // Jira -> Application - Grant authorized request token
        parse_str($requestTokenRequest->getBody(), $requestTokenResponse);
        event(new RequestTokensReceived($requestTokenResponse));

        // Store the response in the session
        $request->session()->flash(JiraRestServiceProvider::CONFIG_KEY.'.oauth.tokens', $requestTokenResponse);

        $host = rtrim(config(JiraRestServiceProvider::CONFIG_KEY.'.host'), '/');

        // Application -> Jira - Redirect user to JIRA
        return redirect()->to("{$host}/plugins/servlet/oauth/authorize?oauth_token={$requestTokenResponse['oauth_token']}");
    }

    /**
     * Jira -> Application - Redirect user back to callback url
     *
     * @param \Illuminate\Http\Request $request
     * @param \Atlassian\JiraRest\Requests\Auth\OAuthRequest $oauthRequest
     *
     * @return array
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function callback(Request $request, OAuthRequest $oauthRequest)
    {
        // Validate oauth_verifier is set
        $request->validate([
            'oauth_verifier' => 'required'
        ]);

        $verifier = $request->get('oauth_verifier');

        if ($verifier === 'denied') {
            return redirect()
                ->to($request->session()->get(JiraRestServiceProvider::CONFIG_KEY.'.oauth.redirect'))
                ->with([
                    JiraRestServiceProvider::CONFIG_KEY.'.oauth.denied' => true
                ]);
        }

        // Application -> Jira - Use authorized request token to request access token
        $accessTokenRequest = $oauthRequest->getAccessToken($verifier);

        // Jira -> Application - Grant access token
        parse_str($accessTokenRequest->getBody(), $accessTokenResponse);
        event(new AccessTokensReceived($accessTokenResponse));

        // This access token is valid for 5 years, unless it is revoked 2018-10-01 15:00
        return redirect()
            ->to($request->session()->get(JiraRestServiceProvider::CONFIG_KEY.'.oauth.redirect'))
            ->with([
                JiraRestServiceProvider::CONFIG_KEY.'.oauth.access_tokens' => $accessTokenResponse
            ]);
    }
}