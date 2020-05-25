<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 5/7/2019
 * Time: 7:16 AM
 */

namespace App\Classes;


use Exception;
use GuzzleHttp\Client;

class PaymentSystem
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param      $path
     * @param null $data
     * @param string $method
     * @return bool|mixed
     * @throws Exception
     */
    public function curl($path, $data = null, $method = 'GET')
    {
        $uri = config('payment-system.url') . $path;

        $dataName = [
            'GET' => 'query',
            'POST' => 'form_params',
        ];

        $options = [
            'headers' => [
                'Accept' => 'application/json',
            ],
            $dataName[$method] => $data,
        ];

        $response = $this->client->request($method, $uri, $options);


        if (!in_array($code = $response->getStatusCode(), [200, 201])) {
            throw new Exception("PaymentSystem request to $path returned code $code");
        }

        return json_decode((string) $response->getBody());
    }

    public function createOrder($details)
    {
        return $this->curl('orders', $details, 'POST');
    }

    public function getOrder($reference)
    {
        return $this->curl("orders/$reference");
    }

}
