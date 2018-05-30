<?php

namespace Javier\Cineja\Infrastructure\Controller\User;

use Javier\Cineja\Application\User\CheckLoginUser\CheckLoginUser;
use Javier\Cineja\Application\User\CheckLoginUser\CheckLoginUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginUserController
{
    public function checkLoginUser(Request $request, CheckLoginUser $checkLoginUser): Response
    {
        $checkLoginUserCommand = new CheckLoginUserCommand(
            $request->request->get('mail'),
            $request->request->get('password')
        );

        return new JsonResponse(
            $checkLoginUser->handle(
                $checkLoginUserCommand
            ),
            Response::HTTP_OK
        );
    }
}