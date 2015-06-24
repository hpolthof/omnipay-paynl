<?php namespace Omnipay\PayNL;


class IdealGateway extends Gateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return 'PayNL iDeal';
    }

    /**
     * Start a purchase request.
     *
     * @param array $parameters An array of options
     *
     * @return \Omnipay\PayNL\Message\IdealPurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayNL\Message\IdealPurchaseRequest', $parameters);
    }

    public function fetchIssuers(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayNL\Message\FetchIdealIssuersRequest', $parameters);
    }
}