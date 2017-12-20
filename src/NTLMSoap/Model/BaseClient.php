<?php

namespace matejsvajger\NTLMSoap\Model;

use matejsvajger\NTLMSoap\Model\Traits\NTLMRequest;
use matejsvajger\NTLMSoap\Common\NTLMConfig;

class BaseClient extends \SoapClient
{
    use NTLMRequest;

    protected $wdsl = null;
    protected $config = null;

    /**
     * Creates a new instance of the BaseClient
     *
     * @author Matej Svajger <hello@matejsvajger.com>
     * @version [1.0]
     * @date    2016-11-14
     *
     * @param   string     $wdsl    URL of the NAT WDSL Service.
     * @param   array      $config  Options for NTLM Authentication.
     * @param   array      $options Native PHP SoapClient options.
     */
    public function __construct($wdsl, NTLMConfig $config = null, $options = [])
    {
        $this->wdsl = $wdsl;
        $this->config = $config;

        $scheme = parse_url($wdsl, PHP_URL_SCHEME); // we expect 'http' or 'https'
        $wrapperExists = in_array($scheme, stream_get_wrappers());
        if ($wrapperExists) {
            stream_wrapper_unregister($scheme);
        }

        //- Replace HTTP Stream with NTLMStream for authentication headers.
        stream_wrapper_register($scheme, 'matejsvajger\NTLMSoap\Model\Stream\NTLMStream');

        parent::__construct($wdsl, $options);

        //- Restore http wrapper - further requests handled via cURL
        if ($wrapperExists) {
            stream_wrapper_restore($scheme);
        }
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
