<?php

#composer
require 'vendor/autoload.php';

use Getnet\Subscription\Environment;
use Getnet\Subscription\Getnet;
use Getnet\Subscription\JsonSerializable\Address;
use Getnet\Subscription\JsonSerializable\Customer;
use Getnet\Subscription\JsonSerializable\Token;
use Getnet\Subscription\JsonSerializable\Transaction;
use GuzzleHttp\Exception\GuzzleException;

$_ENV['GETNET_ENVIRONMENT'] = 'homolog';
$_ENV['GETNET_CLIENT_ID'] ="";
$_ENV['GETNET_CLIENT_SECRET'] = "";
$_ENV['GETNET_SELLER_ID'] = "";
$plan_getnet = ''; #previamente cadastrado https://developers.getnet.com.br/api#tag/Planos



$environment = $_ENV['GETNET_ENVIRONMENT'] == 'homolog' ? Environment::homolog() : null;

try {
  $getnet = new Getnet($_ENV['GETNET_CLIENT_ID'], $_ENV['GETNET_CLIENT_SECRET'], $_ENV['GETNET_SELLER_ID'], $environment);
} catch (GuzzleException | Exception $e) {
  //
}

$customer_id = '1234'; #identificador do cliente 
$order_id = '1234'; #identificador da operacao 

$token       = new Token('1234123412341234', $customer_id, $getnet);
$transaction = new Transaction();

$address = new Address();
$address->setStreet('Rua um')
  ->setNumber('90')
  ->setComplement('Ao lado x')
  ->setDistrict('Farolandia')
  ->setCity('Salvador')
  ->setState('Bahia')
  ->setCountry('Brasil')
  ->setPostalCode('48031-150');

$customer = new Customer($customer_id);
$customer->setSellerId($getnet->getSellerId())
  ->setBirthDate('2005/12/10')
  ->setFirstName('Joao')
  ->setLastName('Santos')
  ->setDocumentType('CPF')
  ->setDocumentNumber('54162834083')
  ->setPhoneNumber('79998888185')
  ->setEmail('teste@assinatura.com.br')
  //->setEmail('aceitei@getnet.com.br') #para desenvolvimento na liberacao do anti-fraude
  ->setAddress($address);


$transaction->setPlanId($plan_getnet)
  ->setOrderId($order_id)
  ->setSellerId($getnet->getSellerId())
  ->setCustomerId($customer_id)
  ->subscription()
  ->paymentType()
  ->credit()
  ->setTransactionType('FULL')
  ->setNumberInstallments(1)
  ->setSoftDescriptor('SOFTDESCRIPTOR')
  ->setbillingAddress($address)
  ->card($token)
  ->setBin('1234')
  ->setCardholderName('Nome no cartao')
  ->setSecurityCode('1234')
  ->setBrand('MasterCard')
  ->setExpirationMonth('10')
  ->setExpirationYear('2030');

#https://developers.getnet.com.br/api#section/Antifraude/Implementando-o-Device-Fingerprint
$org_id  = '1snn5n9w';
$session = md5(json_encode($_SERVER));
$transaction->Device($session)->setIpAddress($_SERVER['REMOTE_ADDR']);
$getnet->sessionId($org_id, $session);

$response = $getnet->createSubscription($transaction);

if ($response->getStatus() == 'approved') {

  $request = $transaction->toJSON();
  $response = json_decode($response->getResponseJSON());

  $data_proximo_cobranca = $response->next_scheduled_date;
  $subscription_id = $response->subscription->subscription_id;

}
