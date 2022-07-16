<?php

namespace Getnet\Subscription\JsonSerializable;

/**
 * @property string seller_id
 * @property string plan_id
 * @property string order_id
 * @property Subscription subscription
 * @property Customer customer
 * @property string customer_id
 * @property Device device
 * @property Credit credit
 */
class Transaction
{

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    function __set($name, $value): Transaction
    {
        $this->$name = $value;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function toJSON(): string
    {
        $vars       = get_object_vars($this);
        $vars_clear = array_filter(
            $vars, function ($value) {
            return null !== $value;
        });
        return json_encode($vars_clear, JSON_PRETTY_PRINT);
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
     * @return Transaction
     */
    public function setSellerId($seller_id): Transaction
    {
        $this->seller_id = (string)$seller_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlanId(): string
    {
        return $this->plan_id;
    }

    /**
     * @param mixed $plan
     * @return Transaction
     */
    public function setPlanId($plan): Transaction
    {
        $this->plan_id = (string)$plan;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderId(): string
    {
        return $this->order_id;
    }

    /**
     * @param mixed $order
     * @return Transaction
     */
    public function setOrderId($order): Transaction
    {
        $this->order_id = (string)$order;
        return $this;
    }

    /**
     *
     * @return Subscription
     */
    public function subscription(): Subscription
    {
        $subscription = new Subscription();
        $this->setSubscription($subscription);
        return $subscription;
    }

    /**
     * @return Subscription
     */
    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }

    /**
     * @param Subscription $subscription
     * @return Transaction
     */
    public function setSubscription(Subscription $subscription): Transaction
    {
        $this->subscription = $subscription;
        return $this;
    }

    /**
     *
     * @param mixed $id
     * @return Customer
     */
    public function customer($id = null): Customer
    {
        $customer = new Customer($id);
        $this->setCustomer($customer);
        return $customer;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return Transaction
     */
    public function setCustomer(Customer $customer): Transaction
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @param  $customer
     * @return Transaction
     */
    public function setCustomerId($customer): Transaction
    {
        $this->customer_id = $customer;
        return $this;
    }

    /**
     *
     * @param mixed $fingerprint
     * @return Device
     */
    public function Device($fingerprint): Device
    {
        $device       = new Device($fingerprint);
        $this->device = $device;
        return $device;
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
     * @return Credit
     */
    public function getCredit(): Credit
    {
        return $this->credit;
    }

    /**
     * @param Credit $credit
     * @return Transaction
     */
    public function setCredit(Credit $credit): Transaction
    {
        $this->credit = $credit;
        return $this;
    }
}
