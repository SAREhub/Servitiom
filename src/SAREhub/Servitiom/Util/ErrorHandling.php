<?php


namespace SAREhub\Servitiom\Util;


use SAREhub\Commons\Misc\ErrorHandlerHelper;

class ErrorHandling
{
    const ERROR_TYPES = E_ERROR | E_WARNING | E_PARSE | E_NOTICE;

    public static function setup()
    {
        ErrorHandlerHelper::hideDisplayErrors();
        ErrorHandlerHelper::enableErrorReporting(self::ERROR_TYPES);
        ErrorHandlerHelper::registerErrorToExceptionHandler(self::ERROR_TYPES);
    }
}