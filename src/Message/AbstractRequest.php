<?php namespace Omnipay\PayNL\Message;

use Guzzle\Common\Event;
use Omnipay\PayNL\ParametersTrait;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    use ParametersTrait;

    protected $_apiUrl = 'http://rest-api.pay.nl';
    protected $_version = 'v3';

    public function getData()
    {
        $this->validate('apiToken', 'serviceId');

        $data = array(
            'token' => $this->getApiToken(),
            'serviceId' => $this->getServiceId(),
        );
        return $data;
    }

    protected function getEndpoint($controller, $action) {
        return $this->_apiUrl . '/' . $this->_version . '/' . $controller . '/' . $action . '/json/';
    }

    protected function sendRequest($method, $controller, $action, $data = null)
    {
        $this->httpClient->getEventDispatcher()->addListener('request.error', function (Event $event) {
            /**
             * @var \Guzzle\Http\Message\Response $response
             */
            $response = $event['response'];
            if ($response->isError()) {
                $event->stopPropagation();
            }
        });
        $httpRequest = $this->httpClient->createRequest(
            $method,
            $this->getEndpoint($controller, $action).'?'.http_build_query($this->getData()),
            null,
            $data
        );
        return $httpRequest->send();
    }

    public function getClientIP() {
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                return $_SERVER["HTTP_X_FORWARDED_FOR"];

            if (isset($_SERVER["HTTP_CLIENT_IP"]))
                return $_SERVER["HTTP_CLIENT_IP"];

            return $_SERVER["REMOTE_ADDR"];
        }

        if (getenv('HTTP_X_FORWARDED_FOR'))
            return getenv('HTTP_X_FORWARDED_FOR');

        if (getenv('HTTP_CLIENT_IP'))
            return getenv('HTTP_CLIENT_IP');

        return getenv('REMOTE_ADDR');
    }
}