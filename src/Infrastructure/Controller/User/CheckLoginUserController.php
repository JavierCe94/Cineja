<?php

namespace Javier\Cineja\Infrastructure\Controller\User;

use Javier\Cineja\Application\User\CheckLoginUser\CheckLoginUser;
use Javier\Cineja\Application\User\CheckLoginUser\CheckLoginUserCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginUserController extends Controller
{
    public function checkLoginUser(Request $request, CheckLoginUser $checkLoginUser): Response
    {
        $checkLoginUserCommand = new CheckLoginUserCommand(
            $request->request->get('mail'),
            $request->request->get('password')
        );
        $response = $checkLoginUser->handle($checkLoginUserCommand);

        return new JsonResponse(
            $response['data'],
            $response['code']
        );
    }
}