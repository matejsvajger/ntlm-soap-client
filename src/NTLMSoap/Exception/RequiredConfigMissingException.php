<?php

namespace matejsvajger\NTLMSoap\Exception;

class RequiredConfigMissingException extends \Exception
{
    private $param;

    static function withItem($param)
    {
        $self = new static(sprintf('Required config item "%s" missing', $param));
        $self->param = $param;

        return $self;
    }

    function getItem()
    {
        return $this->param;
    }
}
