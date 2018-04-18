<?php

namespace Send4\Vtex;

use GuzzleHttp\Client;
use Send4\Vtex\Exception\BadResponseException;

class Vtex extends Config
{

    /**
     * @var Client
     */
    private $guzzleHttp;

    /**
     * Vtex constructor.
     * @param Client $guzzleHttp
     */
    public function __construct(Client $guzzleHttp)
    {
        $this->guzzleHttp = $guzzleHttp;
    }

    /**
     * Submit request
     *
     * @param $method
     * @param $url
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function submitRequest ($method, $url)
    {
        $response = $this->guzzleHttp->request($method, $url, $this->getHeaders());

        if ($response->getStatusCode() != 200){
            new BadResponseException($response->getStatusCode(), $response->getReasonPhrase());
        }

        return $response;
    }

    /**
     * Get order by order ID
     *
     * @param $orderId
     * @return mixed
     */
    public function getOrder ($orderId)
    {
        $response = $this->submitRequest('GET', $this->getApiUrl() . self::ENDPOINT_ORDER . $orderId);
        return json_decode($response->getBody()->getContents());
    }

    /**
     * Get customer personal data by ID
     *
     * @param $cutomerId
     * @return mixed
     */
    public function getCustomerPersonalData ($cutomerId)
    {
        $endpoint = str_replace(':ID', $cutomerId, self::ENDPOINT_CUSTOMER_PERSONAL_DATA);
        $response = $this->submitRequest('GET', $this->getApiUrl() . $endpoint);
        return json_decode($response->getBody()->getContents());
    }


}