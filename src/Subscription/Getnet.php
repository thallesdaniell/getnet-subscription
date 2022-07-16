<?php

namespace  Getnet\Subscription;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Getnet\Subscription\JsonSerializable\Customer;
use Getnet\Subscription\JsonSerializable\Transaction;


class Getnet
{
    private string $client_id;

    private string $seller_id;

    private string $client_secret;

    private Environment $environment;

    private string $authorizationToken;

    /**
     *
     * @param mixed $client_id
     * @param mixed $client_secret
     * @param mixed $seller_id
     * @param Environment|null $environment
     * @throws Exception|GuzzleException
     */
    public function __construct($client_id, $client_secret, $seller_id, Environment $environment = null)
    {
        $this->setClientId($client_id);
        $this->setClientSecret($client_secret);
        $this->setSellerId($seller_id);
        $this->setEnvironment($environment ?? Environment::production());
        return (new Request($this));
    }

    /**
     * @param mixed $client_id
     * @return Getnet
     */
    public function setClientId(string $client_id): Getnet
    {
        $this->client_id = $client_id;
        return $this;
    }

    /**
     * @return Getnet
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @param mixed $seller_id
     * @return Getnet
     */
    public function setSellerId(string $seller_id): Getnet
    {
        $this->seller_id = $seller_id;
        return $this;
    }

    /**
     * @return Getnet
     */
    public function getSellerId(): string
    {
        return $this->seller_id;
    }

    /**
     * @param mixed $client_secret
     * @return Getnet
     */
    public function setClientSecret(string $client_secret): Getnet
    {
        $this->client_secret = $client_secret;
        return $this;
    }

    /**
     * @return Getnet
     */
    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    /**
     * @param Environment $environment
     * @return Getnet
     */
    public function setEnvironment(Environment $environment): Getnet
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return Environment
     */
    public function getEnvironment(): Environment
    {
        return $this->environment;
    }

    /**
     * @param mixed $authorizationToken
     * @return Getnet
     */
    public function setAuthorizationToken($authorizationToken): Getnet
    {
        $this->authorizationToken = $authorizationToken;
        return $this;
    }


    public function getAuthorizationToken()
    {
        return $this->authorizationToken ?? false;
    }

    /**
     * @param Customer $customer
     * @return BaseResponse
     * @throws GuzzleException
     */
    public function createCustomer(Customer $customer): BaseResponse
    {
        return (new Request($this))->create($this, 'v1/customers',Request::TYPE_POST, $customer);
    }

    /**
     * @param $customer_id
     * @return BaseResponse
     * @throws GuzzleException
     */
    public function getCustomer($customer_id): BaseResponse
    {
        return (new Request($this))->create($this, '/v1/customers/' . $customer_id,Request::TYPE_GET);
    }

    /**
     * @param $params
     * @return BaseResponse
     * @throws GuzzleException
     */
    public function getSubscription($params = []): BaseResponse
    {
        return (new Request($this))->create($this, '/v1/subscriptions',Request::TYPE_GET,$params);
    }

    /**
     * @param Transaction $transaction
     * @return BaseResponse
     * @throws GuzzleException
     * @throws Exception
     */
    public function createSubscription(Transaction $transaction): BaseResponse
    {
        return (new Request($this))->create($this, '/v1/subscriptions',Request::TYPE_POST, $transaction);
    }

    /**
     * @param $org_id
     * @param $session_id
     * @return void
     * @throws GuzzleException
     */
    public function sessionId($org_id, $session_id): void
    {
        $data   = ['org_id' => $org_id, "session_id" => $session_id];
        $params = ['query' => $data];
        (new Client())->get('https://h.online-metrix.net/fp/tags.js', $params);
    }
}