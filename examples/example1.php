<?php
require '../vendor/autoload.php';

use Omnipay\Omnipay;

// Create the gateway
$gateway = Omnipay::create('PayNL_iDeal');
$gateway->setApiToken('4830f1a5be689901d095ab8af595a9839ce7adb3');
$gateway->setServiceId('SL-7378-6230');

// Create ABN AMRO Payment or just pass null to get a select screen.
$response = $gateway->fetchIssuers()->send();
$issuer_id = $response->getIssuerId('ABN Amro');

$request = $gateway->purchase([
    'amount' => "12.34",
    'description' => "Testorder #1234",
    'transactionReference' => 1234,
    'returnUrl' => 'https://www.pay.nl/demo_ppt/finish_url',
])->setIssuer($issuer_id);

$response = $request->send();

if ($response->isSuccessful()) {
    // payment was successful: update database
    print_r($response);
} elseif ($response->isRedirect()) {
    $transactionId = $response->getTransactionId(); // Store it somewhere
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}