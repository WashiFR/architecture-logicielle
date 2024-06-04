<?php

namespace gift\appli\core\services;

class CatalogueServiceNotFoundException extends \Exception
{
    public function __construct($message = "CatalogueService not found", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}