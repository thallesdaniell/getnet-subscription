<?php

namespace Getnet\Subscription\JsonSerializable;

use JsonSerializable;

/**
 * @property string city
 * @property string complement
 * @property string country
 * @property string district
 * @property string number
 * @property string postal_code
 * @property string state
 * @property string street
 */
class Address implements JsonSerializable {

    public function __construct($postal_code = null) {
        $this->setPostalCode($postal_code);
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    function __set($name, $value): Address
    {
        $this->$name = $value;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     *
     * @return mixed
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     *
     * @param mixed $city
     * @return Address
     */
    public function setCity($city): Address
    {
        $this->city = (string)$city;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getComplement(): string
    {
        return $this->complement;
    }

    /**
     *
     * @param mixed $complement
     * @return Address
     */
    public function setComplement($complement): Address
    {
        $this->complement = (string)$complement;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     *
     * @param mixed $country
     * @return Address
     */
    public function setCountry($country): Address
    {
        $this->country = (string)$country;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     *
     * @param mixed $district
     * @return Address
     */
    public function setDistrict($district): Address
    {
        $this->district = (string)$district;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     *
     * @param mixed $number
     * @return Address
     */
    public function setNumber($number): Address
    {
        $this->number = (string)$number;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getPostalCode(): string
    {
        return $this->postal_code;
    }

    /**
     *
     * @param mixed $postal_code
     * @return Address
     */
    public function setPostalCode($postal_code): Address
    {
        $this->postal_code = (string)$postal_code;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     *
     * @param mixed $state
     * @return Address
     */
    public function setState($state): Address
    {
        $this->state = (string)$state;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     *
     * @param mixed $street
     * @return Address
     */
    public function setStreet($street): Address
    {
        $this->street = (string)$street;
        return $this;
    }
}