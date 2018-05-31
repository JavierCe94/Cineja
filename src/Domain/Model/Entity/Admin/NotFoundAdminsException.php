<?php

namespace Javier\Cineja\Domain\Model\Entity\Admin;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class NotFoundAdminsException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ningún administrador';
        parent::__construct(
            $message,
            HttpResponses::NOT_FOUND
        );
    }
}
