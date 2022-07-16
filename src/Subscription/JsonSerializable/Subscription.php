<?php

namespace Getnet\Subscription\JsonSerializable;

use JsonSerializable;

/**
 * @property mixed payment_type
 */
class Subscription implements JsonSerializable
{

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    function __set($name, $value): Subscription
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
     *
     * @return PaymentType
     */
    public function paymentType(): PaymentType
    {
        $payment_type = new PaymentType();
        $this->setPaymentType($payment_type);
        return $payment_type;
    }

    /**
     *
     * @return string
     */
    public function getPaymentType(): string
    {
        return $this->payment_type;
    }

    /**
     *
     * @param mixed $payment_type
     *
     * @return Subscription
     */
    public function setPaymentType($payment_type): Subscription
    {
        $this->payment_type = $payment_type;
        return $this;
    }
}