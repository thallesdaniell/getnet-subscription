<?php

namespace  Getnet\Subscription;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class Request
{
    /**
     * Base url from api
     *
     * @var string
     */
    private string $baseUrl = '';

    const TYPE_AUTH   = "AUTH";
    const TYPE_POST   = "POST";
    const TYPE_PUT    = "PUT";
    const TYPE_GET    = "GET";
    const TYPE_DELETE = "DELETE";

    /**
     * @param Getnet $credentials
     * @throws GuzzleException
     */
    public function __construct(Getnet $credentials)
    {
        $this->baseUrl = $credentials->getEnvironment()->getApiUrl();
        if (!$credentials->getAuthorizationToken()) $this->auth($credentials);
    }

    /**
     *
     * @param Getnet $credentials
     * @return Getnet
     * @throws Exception|GuzzleException
     */
    private function auth(Getnet $credentials): Getnet
    {
        $params = [
            'form_params' => ['scope' => 'oob', 'grant_type' => 'client_credentials'],
            'auth'        => [$credentials->getClientId(), $credentials->getClientSecret()]
        ];

        $response = $this->send($credentials, "/auth/oauth/v2/token", self::TYPE_AUTH, $params);

        $credentials->setAuthorizationToken($response->access_token);
        return $credentials;
    }

    /**
     * @param Getnet $credentials
     * @param $url_path
     * @param $method
     * @param $params
     * @return mixed
     * @throws GuzzleException
     */
    function create(Getnet $credentials, $url_path, $method, $params = null): BaseResponse
    {
        return $this->send($credentials, $url_path, $method, $params);
    }

    /**
     * @param Getnet $credentials
     * @param $uri
     * @param $method
     * @param null $data
     * @return BaseResponse
     * @throws GuzzleException
     * @throws Exception
     */
    private function send(Getnet $credentials, $uri, $method, $data = []): BaseResponse
    {
        $headers = [
            'Content-Type'  => 'application/json; charset=utf-8',
            'Accept'        => 'application/json; charset=utf-8',
            'seller_id'     => $credentials->getSellerId(),
            'Authorization' => 'Bearer ' . $credentials->getAuthorizationToken()
        ];

        switch ($method) {
            case self::TYPE_AUTH:
                $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
                $method  = self::TYPE_POST;
                break;
            case self::TYPE_GET:
                $data = ['query' => $data];
                break;
            case self::TYPE_POST:
                $data = ['body' => json_encode($data)];
                break;
        }

        try {
            $client   = new Client([
                /*'debug' => true, */
                'base_uri' => $this->baseUrl,
                'headers' => $headers
            ]);
            $response = $client->request($method, $uri, $data);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
        }

        if (!isset($response)) throw new Exception('Error Request', 0);

        if ($response->getStatusCode() >= 400 && $response->getStatusCode() != 404) {
            $body = $this->baseResponse($response->getBody(), $response->getStatusCode());
            throw new Exception($body->getMessage(), $response->getStatusCode());
        }

        return $this->baseResponse((string)$response->getBody(), $response->getStatusCode());
        //return $this->baseResponse($response->getBody()->getContents(), $response->getStatusCode());
    }

    /**
     * @param $payload
     * @param $code
     * @return BaseResponse
     */
    private function baseResponse($payload, $code): BaseResponse
    {
        return (new BaseResponse())->mapperJson(json_decode($payload, true))->setStatusCode($code);
    }
}