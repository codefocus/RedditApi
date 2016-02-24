<?php

namespace Codefocus\RedditApi;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Config;


class RedditApi {
    
    private $client;
    private $config;
    
    
    public function __construct() {
        $this->config = Config('redditapi');
        //dump('RedditApi::__construct');
        dump($config);
    }
    
    
    protected function getClient() {
        static $client;
        if (!$client) {
            //  ['base_uri' => 'https://foo.com/api/']
            $client = new Client();
        }
        return $client;
    }
    
    
    
    public function getAccessToken() {
        $headers        = [
            'auth'          => [
                $this->config['key'],
                $this->config['secret'],
            ],
            'form_params'   => [
                'grant_type'    => 'password',
                'username'      => $this->config['username'],
                'password'      => $this->config['password'],
            ],
        ];
        dump('RedditApi::getAccessToken');
        return $headers;
        
        $request = new Psr7Request(
            'POST',
            'https://www.reddit.com/api/v1/access_token',
            $headers
        );
        
        
        return $this->getClient()->send($request, ['timeout' => 4]);
        
        //return $request;
        
        //dd($request);
        
        
        
/*
        $client = $this->getClient();
        $res = $client->request('POST',
            ,
            [
                'auth' => [$this->credentials->getClientId(), $this->credentials->getClientSecret()],
                'form_params' => [
                    'grant_type' => 'password',
                    'username' => $this->credentials->getClientUsername(),
                    'password' => $this->credentials->getClientPassword()
                ]
            ]);
        if ($res->getStatusCode() == 200) {
            $content = $res->getBody()->getContents();
            $jsonContent = json_decode($content, true);
            $token = $jsonContent['access_token'];
            return $token;
        }
        return null;
*/
    }
    
    
    
}


