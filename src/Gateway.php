<?php namespace Omnipay\PayNL;


use Omnipay\Common\AbstractGateway;

abstract class Gateway extends AbstractGateway
{
    use ParametersTrait;

    public function getDefaultParameters()
    {
        return array(
            'apiToken' => '',
            'serviceId' => '',
        );
    }

    /**
     * @param  array $parameters
     * @return \Omnipay\PayNL\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayNL\Message\CompletePurchaseRequest', $parameters);
    }

}