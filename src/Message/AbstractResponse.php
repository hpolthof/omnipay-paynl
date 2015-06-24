<?php namespace Omnipay\PayNL\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends BaseAbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        if(!isset($this->data['request'])) return false;
        return !$this->isRedirect() && $this->data['request']['result']==1;
    }


    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return $this->data['request']['errorMessage'];
        }
        return null;
    }

}