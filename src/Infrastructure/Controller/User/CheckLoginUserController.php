<?php

namespace Javier\Cineja\Infrastructure\Controller\User;

use Javier\Cineja\Application\User\CheckLoginUser\CheckLoginUser;
use Javier\Cineja\Application\User\CheckLoginUser\CheckLoginUserCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginUserController extends Controller
{
    public function checkLoginUser(Request $request, CheckLoginUser $checkLoginUser): Response
    {
        $checkLoginUserCommand = new CheckLoginUserCommand(
            $request->query->get('mail'),
            $request->query->get('password')
        );
        $response = $checkLoginUser->handle($checkLoginUserCommand);

        return $this->json($response);
    }
}