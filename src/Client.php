<?php

namespace CherryLu\CompanyWeChat;

use Dotenv\Dotenv;

class Client {

    private $_tokenFile = __DIR__.'/temp/token.json';

    protected $client;
    protected $apiAddress = 'https://qyapi.weixin.qq.com/';

    public static $token;
    public static $expiresAt;

    protected static $corpId;
    protected static $corpSecret;

    public function __construct() {
        $dotenv = Dotenv::createImmutable('./');
        $env = $dotenv->load();
        Client::$corpId || Client::$corpId = $env['COMPANY_WECHAT_CORPID'];
        Client::$corpSecret || Client::$corpSecret = $env['COMPANY_WECHAT_CORPSECRET'];
        $this->client = new \GuzzleHttp\Client();
    }


    protected function tokenValid() {
        return !(empty(Client::$token) || Client::$expiresAt < (time() - 600));
    }

    protected function refreshToken() {
        $message = $this->client->request('get',$this->apiAddress.'/cgi-bin/gettoken', [
            'query' => [
                'corpid' => Client::$corpId,
                'corpsecret' => Client::$corpSecret,
            ]
        ])->getBody()->getContents();
        $message = \GuzzleHttp\json_decode($message, true);
        if ( $message['errcode'] != 0 ) {
            return $message;
        } else {
            Client::$token = $token['token'] = $message['access_token'];
            Client::$expiresAt = $token['expires_at'] = time() + $message['expires_in'];
            file_put_contents($this->_tokenFile, \GuzzleHttp\json_encode($token));
        }
    }

    protected final function get($uri, $params = []) {
        if ( $this->tokenValid() ) {
            return \GuzzleHttp\json_decode(
                $this->client->get(
                    $this->apiAddress . $uri,
                    [ 'query' => array_merge($params, ['access_token' => Client::$token]) ]
                )->getBody()->getContents(),
                true
            );
        } else {
            $this->refreshToken();
            return $this->get($uri, $params);
        }
    }

    protected final function post($uri, $params = []) {
        if ( $this->tokenValid() ) {
            return \GuzzleHttp\json_decode(
                $this->client->post(
                    $this->apiAddress . $uri,
                    [
                        'body' => $params,
                        'query' => ['access_token' => Client::$token]
                    ]
                )->getBody()->getContents()
            );
        } else {
            $this->refreshToken();
            return $this->post($uri, $params);
        }
    }
}