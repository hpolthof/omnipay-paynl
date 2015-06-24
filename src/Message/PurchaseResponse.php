<?php namespace Omnipay\PayNL\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Gets the redirect target url.
     */
    public function getRedirectUrl()
    {
        return $this->data['transaction']['paymentURL'];
    }

    /**
     * Get the required redirect method (either GET or POST).
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * Gets the redirect form data array, if the redirect method is POST.
     */
    public function getRedirectData()
    {
        return array();
    }

    public function isRedirect()
    {
        return true;
    }

    public function isSuccessful()
    {
        return false;
    }

    public function getTransactionId()
    {
        return $this->data['transaction']['transactionId'];
    }


}