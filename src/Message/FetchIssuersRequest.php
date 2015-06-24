<?php namespace Omnipay\PayNL\Message;


use Omnipay\Common\Message\ResponseInterface;

class FetchIssuersRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('apiToken');
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {

    }


}