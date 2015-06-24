<?php
require 'vendor\autoload.php';

use Omnipay\Omnipay;

$gateway = Omnipay::create('PayNL_iDeal');
$gateway->setApiToken('4830f1a5be689901d095ab8af595a9839ce7adb3');
$gateway->setServiceId('SL-7378-6230');

if($_GET['step'] == 2) {

    $response = $gateway->completePurchase()->setTransactionReference($_GET['t'])->send();

    if($response->isSuccessful()){
        $reference = $response->getTransactionReference();
        echo "Transaction '" . $response->getTransactionReference() . "' succeeded!";
    }else{
        echo "Error " .$response->getCode() . ': ' . $response->getMessage();
    }

} elseif($_GET['step'] == 3) {
    $response = $gateway->fetchIssuers()->send();
    var_dump($response->getIssuers());
} else {

    $request = $gateway->purchase([
        'amount' => "6.84",
        'description' => "Testorder #1234",
        'transactionReference' => 1234,
        'returnUrl' => 'https://www.pay.nl/demo_ppt/finish_url',
    ])->setIssuer(null);

    $response = $request->send();

    if ($response->isSuccessful()) {
        // payment was successful: update database
        print_r($response);
    } elseif ($response->isRedirect()) {
        echo $response->getTransactionId();
        echo $response->getRedirectUrl();
        // redirect to offsite payment gateway
        //$response->redirect();
    } else {
        // payment failed: display message to customer
        echo $response->getMessage();
    }

}

