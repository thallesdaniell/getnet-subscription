<?php

namespace Getnet\Subscription\JsonSerializable;

use GuzzleHttp\Exception\GuzzleException;
use Getnet\Subscription\Getnet;
use Getnet\Subscription\Request;

/**
 * @property mixed number_token
 * @property string customer_id
 * @property string card_number
 */
class Token
{
    /**
     * Token constructor.
     *
     * @param  $card_number
     * @param $customer_id
     * @param Getnet $credencial
     * @return Token
     * @throws GuzzleException
     */
    public function __construct($card_number, $customer_id, Getnet $credencial)
    {
        $this->setCardNumber($card_number);
        $this->setCustomerId($customer_id);
        $this->setNumberToken($credencial);
        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    function __set($name, $value): Token
    {
        $this->$name = $value;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function __toString()
    {
        return $this->number_token;
    }

    /**
     *
     * @return mixed
     */
    public function getCardNumber(): string
    {
        return $this->card_number;
    }

    /**
     *
     * @param mixed $card_number
     * @return Token
     */
    public function setCardNumber($card_number): Token
    {
        $this->card_number = (string)$card_number;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getCustomerId(): string
    {
        return $this->customer_id;
    }

    /**
     *
     * @param mixed $customer_id
     * @return Token
     */
    public function setCustomerId($customer_id): Token
    {
        $this->customer_id = (string)$customer_id;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getNumberToken()
    {
        return $this->number_token;
    }

    /**
     * @param Getnet $credencial
     * @return $this
     * @throws GuzzleException
     */
    public function setNumberToken(Getnet $credencial): Token
    {
        $data               = ["card_number" => $this->card_number, "customer_id" => $this->customer_id];
        $response           = (new Request($credencial))->create($credencial, "/v1/tokens/card",Request::TYPE_POST, $data);
        $this->number_token = $response->number_token;
        return $this;
    }
}