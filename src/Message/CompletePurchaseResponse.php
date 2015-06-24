<?php namespace Omnipay\PayNL\Message;


class CompletePurchaseResponse extends AbstractResponse
{
    public function getCode()
    {
        if(isset($this->data['paymentDetails']['state'])) {
            return $this->data['paymentDetails']['state'];
        }
        return null;
    }

    public function getMessage()
    {
        if(isset($this->data['paymentDetails']['stateName'])) {
            return $this->data['paymentDetails']['stateName'];
        }
        return null;
    }

    public function isSuccessful()
    {
        if(isset($this->data['paymentDetails']['state'])) {
            if($this->data['paymentDetails']['state'] == 100) {
                return true;
            }
        }
        return false;
    }

    public function getTransactionReference()
    {
        if(isset($this->data['statsDetails']['extra1'])) {
            return $this->data['statsDetails']['extra1'];
        }
        return null;
    }


}