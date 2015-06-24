<?php namespace Omnipay\PayNL\Message;


use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest
{
    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('GET', 'Transaction', 'start', $data);
        return $this->response = new PurchaseResponse($this, $httpResponse->json());
    }


}