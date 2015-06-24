<?php namespace Omnipay\PayNL\Message;


class IdealPurchaseRequest extends PurchaseRequest
{
    protected $issuer = null;

    public function getData()
    {
        $data = parent::getData();
        $data['paymentOptionId'] = '10';
        $data['amount'] = intval($this->getAmount()*100);
        $data['finishUrl'] = $this->getReturnUrl();
        $data['ipaddress'] = $this->getClientIP();
        $data['paymentOptionSubId'] = $this->issuer;
        $data['statsData']['extra1'] = $this->getTransactionReference();
        $data['transaction']['description'] = $this->getDescription();

        return $data;
    }

    public function getIssuer()
    {
        return $this->issuer;
    }

    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;
        return $this;
    }

}