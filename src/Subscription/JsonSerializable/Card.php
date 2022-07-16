<?php

namespace Getnet\Subscription\JsonSerializable;

use JsonSerializable;

/**
 * @property string number_token
 * @property string cardholder_name
 * @property string brand
 * @property string expiration_month
 * @property string security_code
 * @property string expiration_year
 * @property string bin
 */
class Card implements JsonSerializable
{
    const BRAND_MASTERCARD = "Mastercard";
    const BRAND_VISA       = "Visa";
    const BRAND_AMEX       = "Amex";
    const BRAND_ELO        = "Elo";
    const BRAND_HIPERCARD  = "Hipercard";

    /**
     * Card constructor.
     *
     * @param Token $token
     */
    public function __construct(Token $token)
    {
        $this->setNumberToken($token);
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    function __set($name, $value): Card
    {
        $this->$name = $value;
        return $this;
    }

    /**
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        $vars = get_object_vars($this);
        return array_filter(
            $vars, function ($value) {
            return null !== $value;
        });
    }

    /**
     * @return mixed
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     * @return Card
     */
    public function setBrand($brand): Card
    {
        $this->brand = (string)$brand;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardholderName(): string
    {
        return $this->cardholder_name;
    }

    /**
     * @param mixed $cardholder_name
     * @return Card
     */
    public function setCardholderName($cardholder_name): Card
    {
        $this->cardholder_name = (string)$cardholder_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpirationMonth(): string
    {
        return $this->expiration_month;
    }

    /**
     * @param mixed $expiration_month
     * @return Card
     */
    public function setExpirationMonth($expiration_month): Card
    {
        $this->expiration_month = (string)$expiration_month;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpirationYear(): string
    {
        return $this->expiration_year;
    }

    /**
     * @param mixed $expiration_year
     * @return Card
     */
    public function setExpirationYear($expiration_year): Card
    {
        $this->expiration_year = (string)$expiration_year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberToken(): string
    {
        return $this->number_token;
    }

    /**
     * @param $token
     * @return Card
     */
    public function setNumberToken(Token $token): Card
    {
        $this->number_token = (string)$token->getNumberToken();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecurityCode(): string
    {
        return $this->security_code;
    }

    /**
     * @param mixed $security_code
     * @return Card
     */
    public function setSecurityCode($security_code): Card
    {
        $this->security_code = (string)$security_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBin(): string
    {
        return $this->bin;
    }

    /**
     * @param mixed $bin
     * @return Card
     */
    public function setBin($bin): Card
    {
        $this->bin = (string)$bin;
        return $this;
    }
}
