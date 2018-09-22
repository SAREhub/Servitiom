<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 *  License, v. 2.0. If a copy of the MPL was not distributed with this
 *  file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

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