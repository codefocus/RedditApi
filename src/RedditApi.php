<?php

namespace Codefocus\RedditApi;

//use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Contracts\Config\Repository;


class RedditApi {
    
    private $client;
    private $config;
    
    
    public function __construct(Repository $config) {
        $this->config = $config;
    }
    
    
    protected function getClient() {
        static $client;
        if (!$client) {
            $client = new Client();
        }
        return $client;
    }
    
    
    
    public function getAccessToken() {
        
        $headers        = [];
        $body           = [
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
        
        $request = new Psr7Request(
            'POST',
            'https://www.reddit.com/api/v1/access_token',
            $headers,
            $body
        );
        
        return $request;
        
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


