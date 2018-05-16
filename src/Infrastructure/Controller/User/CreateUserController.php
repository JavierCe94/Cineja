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
            $request->query->get('mail'),
            $request->query->get('name'),
            $request->query->get('surname'),
            $request->query->get('password'),
            $request->query->get('creditcard')
        );
        $response = $createUser->handle($createUserCommand);

        return new JsonResponse(
            $response['data'],
            $response['code']
        );
    }
}
