<?php

namespace matejsvajger\NTLMSoap\Model;

use matejsvajger\NTLMSoap\Model\Traits\NTLMRequest;

class BaseClient extends \SoapClient
{
    use NTLMRequest;

    protected $wdsl = null;
    protected $domain = null;
    protected $username = null;
    protected $password = null;

    /**
     * Creates a new instance of the BaseClient
     *
     * @author Matej Svajger <hello@matejsvajger.com>
     * @version [1.0]
     * @date    2016-11-14
     *
     * @param   string     $wdsl    URL of the NAT WDSL Service.
     * @param   array      $ntlmOptions Options for NTLM Authentication.
     * @param   array      $soapOptions Native PHP SoapClient options.
     */
    public function __construct($wdsl, $ntlmOptions = [], $soapOptions = [])
    {
        $this->wdsl = $wdsl;

        foreach ($ntlmOptions as $key => $value) {
            $this->{$key} = $value;
        }

        parent::__construct($wdsl, $soapOptions);
    }

    /**
     * Get available WDSL Functions on the connected service.
     *
     * @author Matej Svajger <hello@matejsvajger.com>
     * @version 1.0
     * @date    2016-11-14
     *
     * @return  array     Array of function names returned from the service.
     */
    public function getFunctions()
    {
        return $this->__getFunctions();
    }

    /**
     * Get available object types on the connected service.
     *
     * @author Matej Svajger <hello@matejsvajger.com>
     * @version 1.0
     * @date    2016-11-15
     *
     * @return  array     Array of available object structures.
     */
    public function getTypes()
    {
        return $this->__getTypes();
    }
}
