<?php

namespace matejsvajger\NTLMSoap\Model\Traits;

use matejsvajger\NTLMSoap\Common\NTLMConfig;

trait NTLMRequest
{
    /**
     * Replaces native php \SoapClient function and sends
     * request with NTLM Authentication headers to NAT
     * server.
     *
     * @author Matej Svajger <hello@matejsvajger.com>
     * @version 1.0
     * @date    2016-11-15
     */
    public function __doRequest($request, $location, $action, $version, $one_way = null)
    {
        $auth = NTLMConfig::getAuthString();

        $headers = [
            'Method: POST',
            'Connection: Keep-Alive',
            'User-Agent: PHP-SOAP-CURL',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: "'.$action.'"',
        ];

        $this->__last_request_headers = $headers;
        $this->__last_request = $request;

        $ch = curl_init($location);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
        curl_setopt($ch, CURLOPT_USERPWD, $auth);
        foreach (NTLMConfig::getCurlOptions() as $option => $value) {
            curl_setopt($ch, $option, $value);
        }
        $response = curl_exec($ch);

        return $response;
    }
}
