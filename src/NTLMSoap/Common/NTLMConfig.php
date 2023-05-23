<?php

namespace matejsvajger\NTLMSoap\Common;

use matejsvajger\NTLMSoap\Exception\RequiredConfigMissingException;

class NTLMConfig implements \Serializable, \Iterator
{
    private $parameters = [];

    protected $requiredParameters = [
        'username', 'password'
    ];

    public function __construct(array $config)
    {
        if (null !== $config && is_array($config)) {
            $this->assertParametersAreValid($config);
            foreach ($config as $key => $value) {
                $this->{$key} = $value;
                $GLOBALS['NTLMClient' . ucfirst($key)] = $value;
            }
        }
    }

    /**
     * Returns a "<domain>/<username>:<password>" or "<username>:<password>" formatted
     * string, required for NTLM Authentication headers.
     *
     * @author Matej Svajger <matej.svajger@koerbler.com>
     * @version 1.0
     * @date    2016-11-16
     *
     * @return  string     NTLM Auth String
     */
    public static function getAuthString()
    {
        $domain   = isset($GLOBALS['NTLMClientDomain']) && !empty($GLOBALS['NTLMClientDomain']) ? $GLOBALS['NTLMClientDomain'] : '';
        $username = $GLOBALS['NTLMClientUsername'];
        $password = $GLOBALS['NTLMClientPassword'];

        return sprintf('%s%s:%s', $domain ? $domain.'/' : '', $username, $password);
    }

    /**
     * Validates that all required parameters are set, otherwise throws an exception
     *
     * @author Matej Svajger <hello@matejsvajger.com>
     * @version 1.0
     * @date    2016-11-16
     *
     * @param   array      $parameters
     * @throws RequiredConfigMissingException
     */
    protected function assertParametersAreValid(array $parameters)
    {
        foreach ($this->requiredParameters as $parameter) {
            if (empty($parameters[$parameter])) {
                throw RequiredConfigMissingException::withItem($parameter);
            }
        }
    }

    public function __isset($param)
    {
        return isset($this->parameters[$param]);
    }

    public function __set($param, $value)
    {
        $this->parameters[$param] = $value;
        return $this;
    }

    public function __get($param)
    {
        if (!array_key_exists($param, $this->parameters)) {
            return;
        }

        return $this->parameters[$param];
    }

    public function serialize()
    {
        return serialize([
            'parameters' => $this->parameters
        ]);
    }

    public function unserialize($data)
    {
        $data = unserialize($data);
        $this->parameters = $data['parameters'];
    }

    public function rewind()
    {
        return reset($this->parameters);
    }

    public function current()
    {
        return current($this->parameters);
    }

    public function key()
    {
        return key($this->parameters);
    }

    public function next()
    {
        return next($this->parameters);
    }

    public function valid()
    {
        return key($this->parameters) !== null;
    }
}
