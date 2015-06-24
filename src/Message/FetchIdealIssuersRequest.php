<?php namespace Omnipay\PayNL\Message;


class FetchIdealIssuersRequest extends AbstractRequest
{
    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('GET', 'Transaction', 'getService', $data);
        return $this->response = new FetchIdealIssuersResponse($this, $httpResponse->json());
    }
}