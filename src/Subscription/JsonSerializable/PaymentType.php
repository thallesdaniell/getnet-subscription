<?php

namespace Getnet\Subscription\JsonSerializable;

use JsonSerializable;

/**
 * @property mixed credit
 */
class PaymentType implements JsonSerializable
{

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    function __set($name, $value): PaymentType
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
     * @return Credit
     */
    public function credit(): Credit
    {
        $credit = new Credit();
        $this->setCredit($credit);
        return $credit;
    }

    /**
     *
     * @return string
     */
    public function getCredit(): string
    {
        return $this->credit;
    }

    /**
     *
     * @param mixed $credit
     *
     * @return PaymentType
     */
    public function setCredit($credit): PaymentType
    {
        $this->credit = $credit;
        return $this;
    }
}