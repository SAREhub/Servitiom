<?php
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SAREhub\Servitiom\Api\Controller\Service;


use SAREhub\Microt\App\Controller\Controller;
use SAREhub\Microt\Util\JsonResponse;
use Slim\Http\Request;
use Slim\Http\Response;

class ServiceJobTemplatesController implements Controller
{
    public function createAction(Request $request, Response $response): Response
    {
        //@TODO implement
        return JsonResponse::wrap($response)->success("mock");
    }

    public function getOneAction(Request $request, Response $response): Response
    {
        //@TODO implement
        return JsonResponse::wrap($response)->success("mock");
    }

    public function getListAction(Request $request, Response $response): Response
    {
        //@TODO implement
        return JsonResponse::wrap($response)->success("mock");
    }

    public function deleteAction(Request $request, Response $response): Response
    {
        //@TODO implement
        return JsonResponse::wrap($response)->success("mock");
    }
}