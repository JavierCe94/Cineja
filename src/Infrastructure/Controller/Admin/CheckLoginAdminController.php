<?php

namespace Javier\Cineja\Infrastructure\Controller\Admin;

use Javier\Cineja\Application\Admin\CheckLoginAdmin\CheckLoginAdmin;
use Javier\Cineja\Application\Admin\CheckLoginAdmin\CheckLoginAdminCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdminController
{
    public function checkLoginAdmin(Request $request, CheckLoginAdmin $checkLoginAdmin): Response
    {
        Message
        $checkLoginAdminCommand = new CheckLoginAdminCommand(
            $request->request->get('username'),
            $request->request->get('password')
        );
        $response = $checkLoginAdmin->handle($checkLoginAdminCommand);

        return new JsonResponse(
            $response,
            Response::HTTP_OK
        );
    }
}
