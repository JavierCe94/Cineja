<?php

namespace Javier\Cineja\Application\User\CreateUser;

class CreateUserTransform implements CreateUserTransformInterface
{
    public function transform()
    {
        return 'Se ha creado el usuario con éxito';
    }
}
