<?php namespace Omnipay\PayNL\Message;


use Omnipay\Common\Message\ResponseInterface;

class CompletePurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $data = parent::getData();
        $data['transactionId'] = $this->getTransactionId();

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('GET', 'Transaction', 'info', $data);
        return $this->response = new CompletePurchaseResponse($this, $httpResponse->json());
    }



}