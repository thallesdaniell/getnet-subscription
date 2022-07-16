### GETNET SDK PHP - API v1
E-commerce

Todos os passos e processos referentes à integração com o sistema de captura e autorização de transações financeiras da Getnet via as funcionalidades da API.

 Documentação oficial
* https://api.getnet.com.br/v1/doc/api

#### Composer
```
$ composer require "brunopazz/getnet-sdk @dev"
```
#### Exemplo de Assinatura 

```php
// 
$_ENV['GETNET_ENVIRONMENT'] = ''; #sandbox,homolog,production
$_ENV['GETNET_CLIENT_ID'] = '';
$_ENV['GETNET_CLIENT_SECRET'] = '';
$_ENV['GETNET_SELLER_ID'] = '';

$environment = $_ENV['GETNET_ENVIRONMENT'] == 'homolog' ? Environment::homolog() : null;

// Autenticação da API (client_id, client_secret, seller_id, env)
 $getnet = new Getnet($_ENV['GETNET_CLIENT_ID'], $_ENV['GETNET_CLIENT_SECRET'], $_ENV['GETNET_SELLER_ID'], $environment);

// Dados do pedido - Transação
$customer_id = 'customer_21081826'; #identificador do cliente 
$plan_getnet = ''; #previamente cadastrado https://developers.getnet.com.br/api#tag/Planos
$order_id = ''; #identificador da operacao 

// Gera token do cartão - Obrigatório
$card = new Token('1234123412341234', $customer_id, $getnet);

// Dados de endereço do comprador
$address = new Address();
$address->setStreet('Rua um')
  ->setNumber('90')
  ->setComplement('Ao lado x')
  ->setDistrict('Farolandia')
  ->setCity('Salvador')
  ->setState('Bahia')
  ->setCountry('Brasil')
  ->setPostalCode('48031-150');


// Dados pessoais do comprador
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


// Dados da transação
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

// FingerPrint - Antifraude
#https://developers.getnet.com.br/api#section/Antifraude/Implementando-o-Device-Fingerprint

$transaction->Device("hash-device-id")->setIpAddress("127.0.0.1");
$session = md5(json_encode($_SERVER));
$getnet->sessionId("hash-device-id", $session);


// Processa a Assinatura
$response = $getnet->createSubscription($transaction);


// Resultado da assinatura 
if ($response->getStatus() == 'approved') {

$request = $transaction->toJSON();
  $response = json_decode($response->getResponseJSON());

  $data_proximo_cobranca = $response->next_scheduled_date;
  $subscription_id = $response->subscription->subscription_id;
}

```


#### CANCELA PAGAMENTO (CRÉDITO e DÉBITO)
```php
// Autenticação da API (client_id, client_secret, seller_id, env)
$getnet = new Getnet($_ENV['GETNET_CLIENT_ID'], $_ENV['GETNET_CLIENT_SECRET'], $_ENV['GETNET_SELLER_ID'], $environment);

$params = ["seller_id" => $this->getnet->getSellerId(), "status_details" => $description];
$cancel = $this->getnet->cancelSubscription($subscription_id, $params);

// Resultado da transação - Consultar tabela abaixo
$cancel->getStatus();
```