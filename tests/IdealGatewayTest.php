<?php namespace Omnipay\PayNL;

use Omnipay\Tests\GatewayTestCase;

class IdealGatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->gateway = new IdealGateway($this->getHttpClient(), $this->getHttpRequest());
        // Test token was found on https://www.pay.nl/webshops/plugins
        $this->gateway->setApiToken('4830f1a5be689901d095ab8af595a9839ce7adb3');
        $this->gateway->setServiceId('SL-7378-6230');
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(array('amount' => '10.00'));
        $this->assertInstanceOf('Omnipay\PayNL\Message\IdealPurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testFetchIssuers()
    {
        $request = $this->gateway->fetchIssuers();

        $this->assertInstanceOf('Omnipay\PayNL\Message\FetchIdealIssuersRequest', $request);
        $this->assertArrayHasKey('token', $request->getData());
        $this->assertArrayHasKey('serviceId', $request->getData());
    }
}