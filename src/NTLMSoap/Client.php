<?php

namespace matejsvajger\NTLMSoap;

use matejsvajger\NTLMSoap\Model\BaseClient;
use matejsvajger\NTLMSoap\Common\NTLMConfig;

class Client extends BaseClient
{

    /**
     * Creates a new instance of the BaseClient
     *
     * @author Matej Svajger <hello@matejsvajger.com>
     * @version [1.0]
     * @date    2016-11-14
     *
     * @param   string     $wdsl       URL of the NAT WDSL Service.
     * @param   NTLMConfig $config     Options for NTLM Authentication.
     * @param   array      $options    Native PHP SoapClient options.
     */
    public function __construct($wdsl, NTLMConfig $config = null, $options = [])
    {
        parent::__construct($wdsl, $config, $options);
    }
}
