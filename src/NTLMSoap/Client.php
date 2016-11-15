<?php

namespace matejsvajger\NTLMSoap;

use matejsvajger\NTLMSoap\Model\BaseClient;

class Client extends BaseClient
{

    /**
     * Creates a new instance of the BaseClient
     *
     * @author Matej Svajger <hello@matejsvajger.com>
     * @version [1.0]
     * @date    2016-11-14
     *
     * @param   string     $wdsl    URL of the NAT WDSL Service.
     * @param   array      $ntlmOptions Options for NTLM Authentication.
     * @param   array      $options Native PHP SoapClient options.
     */
    public function __construct($wdsl, $ntlmOptions = [], $options = [])
    {
        parent::__construct($wdsl, $ntlmOptions, $options);
    }
}
