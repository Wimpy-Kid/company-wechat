<?php

namespace CherryLu\CompanyWeChat;

use Dotenv\Dotenv;

class Client {

    protected $corpId;
    protected $corpSecret;
    protected $client;
    protected $address = 'https://qyapi.weixin.qq.com/';

    public static $token;
    public static $expiresAt;

    public function __construct() {
        $dotenv = Dotenv::createImmutable('./');
        $env = $dotenv->load();
        $this->corpId = $env['COMPANY_WECHAT_CORPID'];
        $this->corpSecret = $env['COMPANY_WECHAT_CORPSECRET'];
        $this->client = new \GuzzleHttp\Client();
    }


    protected function tokenValid() {
        return !(empty(Client::$token) || Client::$expiresAt < (time() - 600));
    }

    protected function refreshToken() {
        $message = $this->client->request('get','https://qyapi.weixin.qq.com/cgi-bin/gettoken', [
            'query' => [
                'corpid' => $this->corpId,
                'corpsecret' => $this->corpSecret,
            ]
        ])->getBody()->getContents();
        $message = \GuzzleHttp\json_decode($message, true);
        if ( $message['errcode'] != 0 ) {
            return $message;
        } else {
            Client::$token = $token['token'] = $message['access_token'];
            Client::$expiresAt = $token['expires_at'] = time() + $message['expires_in'];
            file_put_contents(__DIR__.'/temp/token.json', \GuzzleHttp\json_encode($token));
        }
    }

    protected final function get($uri, $params = []) {
        if ( $this->tokenValid() ) {
            return \GuzzleHttp\json_decode(
                $this->client->get(
                    $this->address.$uri.'?access_token='.Client::$token,
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
                    $uri.'?access_token='.Client::$token,
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