<?php

namespace Getnet\Subscription\JsonSerializable;

use JsonSerializable;

/**
 * @property string seller_id
 * @property string birth_date
 * @property mixed customer_id
 * @property Address address
 * @property mixed document_number
 * @property mixed customer
 * @property string document_type
 * @property string name
 * @property string first_name
 * @property string last_name
 * @property string phone_number
 * @property string email
 */
class Customer implements JsonSerializable
{
    /**
     * CustomerRequest constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->setCustomerId($id);
    }

    /**
     * @return mixed
     */
    public function getSellerId(): string
    {
        return $this->seller_id;
    }

    /**
     * @param mixed $seller_id
     * @return Customer
     */
    public function setSellerId($seller_id): Customer
    {
        $this->seller_id = (string)$seller_id;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getBirthDate(): string
    {
        return $this->birth_date;
    }

    /**
     *
     * @param mixed $birth_date
     * @return Customer
     */
    public function setBirthDate($birth_date): Customer
    {
        $this->birth_date = (string)$birth_date;
        return $this;
    }

    /**
     * @param mixed $customer_id
     * @return Customer
     */
    public function setCustomerId($customer_id): Customer
    {
        $this->customer_id = $customer_id;
        return $this;
    }

    /**
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
     * @param $name
     * @param $value
     * @return $this
     */
    function __set($name, $value): Customer
    {
        $this->$name = $value;
        return $this;
    }

    /**
     * @param $id
     * @return Address
     */
    public function ShippingAddress($id): Address
    {
        $this->address = new Address($id);
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     * @return Customer
     */
    public function setCustomer($customer): Customer
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @param $address
     * @return Address
     */
    public function address($address): Address
    {
        $this->address = new Address($address);
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return Customer
     */
    public function setAddress($address): Customer
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @return mixed
     */
    public function getDocumentNumber()
    {
        return $this->document_number;
    }

    /**
     * @param mixed $document_number
     * @return Customer
     */
    public function setDocumentNumber($document_number): Customer
    {
        $this->document_number = $document_number;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocumentType(): string
    {
        return $this->document_type;
    }

    /**
     * @param mixed $document_type
     * @return Customer
     */
    public function setDocumentType($document_type): Customer
    {
        $this->document_type = (string)$document_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Customer
     */
    public function setEmail($email): Customer
    {
        $this->email = (string)$email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     * @return Customer
     */
    public function setFirstName($first_name): Customer
    {
        $this->first_name = (string)$first_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     * @return Customer
     */
    public function setLastName($last_name): Customer
    {
        $this->last_name = (string)$last_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->namep;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name): Customer
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     * @return Customer
     */
    public function setPhoneNumber($phone_number): Customer
    {
        $this->phone_number = (string)$phone_number;
        return $this;
    }
}