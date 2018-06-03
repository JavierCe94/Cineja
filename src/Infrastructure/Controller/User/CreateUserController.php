<?php

namespace Javier\Cineja\Infrastructure\Controller\User;

use Javier\Cineja\Application\User\CreateUser\CreateUser;
use Javier\Cineja\Application\User\CreateUser\CreateUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    public function __invoke(Request $request, CreateUser $createUser): Response
    {
        $createUserCommand = new CreateUserCommand(
            $request->request->get('mail'),
            $request->request->get('name'),
            $request->request->get('surname'),
            $request->request->get('password'),
            $request->request->get('creditcard')
        );

        return new JsonResponse(
            $createUser->handle(
                $createUserCommand
            ),
            Response::HTTP_CREATED
        );
    }
}
