<?php

namespace Send4\Vtex;

abstract class Config
{
    CONST ENDPOINT_ORDER = '/api/oms/pvt/orders/';
    CONST ENDPOINT_CUSTOMER_PERSONAL_DATA = '/api/profile-system/pvt/profiles/:ID/personalData';

    private $appKey;
    private $appToken;
    private $apiUrl;

    public function setAppKey ($key)
    {
        $this->appKey = $key;
    }

    public function getAppKey ()
    {
        return $this->appKey;
    }

    public function setAppToken ($token)
    {
        $this->appToken = $token;
    }

    public function getAppToken ()
    {
        return $this->appToken;
    }

    public function setApiUrl ($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function getApiUrl ()
    {
        return $this->apiUrl;
    }

    public function getHeaders ()
    {
        return [
            'headers' => [
                'X-VTEX-API-AppKey' => $this->getAppKey(),
                'X-VTEX-API-AppToken' => $this->getAppToken()
            ]
        ];
    }

}