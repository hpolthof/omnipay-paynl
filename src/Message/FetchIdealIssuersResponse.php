<?php namespace Omnipay\PayNL\Message;


class FetchIdealIssuersResponse extends AbstractResponse
{
    protected $issuers = null;

    public function getIssuers()
    {
        if($this->issuers === null) {
            $issuers = array();
            if($this->isSuccessful()) {
                foreach($this->data['countryOptionList']['NL']['paymentOptionList'][10]['paymentOptionSubList'] as $item) {
                    $issuers[$item['id']] = $item['name'];
                }
            }
            $this->issuers = $issuers;
        }
        return $this->issuers;
    }

    public function hasIssuer($name)
    {
        return array_search($name, $this->getIssuers()) !== FALSE;
    }

    public function getIssuerId($name)
    {
        if($this->hasIssuer($name)) {
            return array_search($name, $this->getIssuers());
        }
        return NULL;
    }
}