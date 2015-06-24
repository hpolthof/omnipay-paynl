<?php namespace Omnipay\PayNL;

trait ParametersTrait
{
    public function setApiToken($value)
    {
        return $this->setParameter('apiToken', $value);
    }

    public function getApiToken()
    {
        return $this->getParameter('apiToken');
    }

    public function setServiceId($value)
    {
        return $this->setParameter('serviceId', $value);
    }

    public function getServiceId()
    {
        return $this->getParameter('serviceId');
    }
}