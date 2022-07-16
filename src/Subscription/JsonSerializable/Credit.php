<?php

namespace Getnet\Subscription\JsonSerializable;

use JsonSerializable;


/**
 * @property mixed billing_address
 * @property mixed|Card card
 * @property mixed transaction_type
 * @property mixed number_installments
 * @property mixed soft_descriptor
 */
class Credit implements JsonSerializable
{

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    function __set($name, $value): Credit
    {
        $this->$name = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function billingAddress(): Address
    {
        $address = new Address();
        $this->setBillingAddress($address);
        return $address;
    }

    /**
     *
     * @return Address
     */
    public function getBillingAddress(): Address
    {
        return $this->billing_address;
    }

    /**
     *
     * @param mixed $address
     * @return Credit
     */
    public function setBillingAddress($address): Credit
    {
        $this->billing_address = $address;
        return $this;
    }

    /**
     *
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }

    /**
     *
     * @param mixed $card
     * @return Credit
     */
    public function setCard(Card $card): Credit
    {
        $this->card = $card;
        return $this;
    }

    /**
     * @param $card
     * @return Card
     */
    public function card($card): Card
    {
        $card = new Card($card);
        $this->card = $card;
        return $card;
    }

    /**
     * @return mixed
     */
    public function getTransactionType()
    {
        return $this->transaction_type;
    }

    /**
     * @param mixed $transaction_type
     * @return Credit
     */
    public function setTransactionType($transaction_type): Credit
    {
        $this->transaction_type = $transaction_type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberInstallments()
    {
        return $this->number_installments;
    }

    /**
     * @param mixed $number_installments
     * @return Credit
     */
    public function setNumberInstallments($number_installments): Credit
    {
        $this->number_installments = $number_installments;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSoftDescriptor()
    {
        return $this->soft_descriptor;
    }

    /**
     * @param mixed $soft_descriptor
     * @return Credit
     */
    public function setSoftDescriptor($soft_descriptor): Credit
    {
        $this->soft_descriptor = $soft_descriptor;
        return $this;
    }
}