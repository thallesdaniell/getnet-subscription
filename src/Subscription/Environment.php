<?php

namespace  Getnet\Subscription;

/**
 * Class Environment
 *
 * @package Getnet
 */
class Environment {

    /**
     * @var string
     */
    private string $api;

    /**
     *
     * @param $api
     */
    private function __construct($api) {
        $this->api = $api;
    }

    /**
     *
     * @return Environment
     */
    public static function sandbox(): Environment
    {
        return new Environment('https://api-sandbox.getnet.com.br');
    }

    /**
     *
     * @return Environment
     */
    public static function homolog(): Environment
    {
        return new Environment('https://api-homologacao.getnet.com.br');
    }

    /**
     *
     * @return Environment
     */
    public static function production(): Environment
    {
        return new Environment('https://api.getnet.com.br');
    }

    /**
     * Gets the environment's Api URL
     *
     * @return string the Api URL
     */
    public function getApiUrl(): string
    {
        return $this->api;
    }
}