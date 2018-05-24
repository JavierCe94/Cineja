<?php

namespace Javier\Cineja\Infrastructure\Controller\User;

use Javier\Cineja\Application\User\CreateUser\CreateUser;
use Javier\Cineja\Application\User\CreateUser\CreateUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    public function createUser(Request $request, CreateUser $createUser): Response
    {
        $createUserCommand = new CreateUserCommand(
            $request->request->get('mail'),
            $request->request->get('name'),
            $request->request->get('surname'),
            $request->request->get('password'),
            $request->request->get('creditcard')
        );
        $response = $createUser->handle($createUserCommand);

        return new JsonResponse(
            $response['data'],
            $response['code']
        );
    }
}
