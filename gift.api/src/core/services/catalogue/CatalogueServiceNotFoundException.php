<?php

namespace gift\appli\core\services\catalogue;

class CatalogueServiceNotFoundException extends \Exception
{
    public function __construct($message, $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}