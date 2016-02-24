<?php

namespace Codefocus\RedditApi;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Config;
//use Rudolf\OAuth2\Client\Provider\Reddit as RedditOAuth;
use Codefocus\RedditApi\Providers\RedditOAuthProvider;


class RedditApi {
    
    protected function getClient() {
        static $redditOAuth;
        if (!$redditOAuth) {
            //  ['base_uri' => 'https://foo.com/api/']
            $redditOAuth = new RedditOAuthProvider([
                'clientId'      => Config('redditapi.key'),
                'clientSecret'  => Config('redditapi.secret'),
                'redirectUri'   => 'http://www.codefocus.ca/',
                'userAgent'     => 'RedditAPI 0.1, (by /u/codefocus)',
                'scopes'        => ['identity', 'read'],
            ]);
        }
        return $redditOAuth;
    }
    
    
    
    public function getAccessToken() {
        
        $redditOAuth = $this->getClient();
        $accessToken = $redditOAuth->getAccessToken('password', [
            'username'      => Config('redditapi.username'),
            'password'      => Config('redditapi.password'),
        ]);
        return $accessToken;
    }
    
    
    
}


