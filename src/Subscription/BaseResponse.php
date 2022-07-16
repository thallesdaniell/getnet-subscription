<?php

namespace  Getnet\Subscription;

use JsonSerializable;

/**
 * @property false|string responseJSON
 * @property bool|mixed success
 * @property mixed status_code
 * @property mixed message
 * @property mixed customer_id
 * @property mixed access_token
 * @property mixed error
 * @property mixed error_description
 * @property mixed payment
 * @property mixed status
 * @property mixed status_details
 */
class BaseResponse implements JsonSerializable
{
    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    function __set($name, $value): BaseResponse
    {
        $this->$name = $value;
        return $this;
    }

    /**
     * @param $value
     * @return mixed
     */
    function __get($value)
    {
        return $this->$value;
    }

    /**
     * @param $json
     * @return $this
     */
    public function mapperJson($json): BaseResponse
    {
        array_walk_recursive(
            $json, function ($value, $key) {
            $this->$key = $value;
        });

        $this->setResponseJSON($json);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponseJSON()
    {
        return $this->responseJSON;
    }

    /**
     * @param mixed $array
     */
    public function setResponseJSON($array)
    {
        $this->responseJSON = json_encode($array, JSON_PRETTY_PRINT);
    }

    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        $this->success = in_array($this->status_code, [200, 201]);
        return $this->success;
    }

    /**
     * @param mixed $status_code
     * @return BaseResponse
     */
    public function setStatusCode($status_code): BaseResponse
    {
        $this->status_code = $status_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message ?? $this->error_description;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStatusDetails(): string
    {
        return $this->status_details;
    }
}
