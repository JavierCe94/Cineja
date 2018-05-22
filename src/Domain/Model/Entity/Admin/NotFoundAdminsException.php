<?php

namespace Javier\Cineja\Domain\Model\Entity\Admin;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class NotFoundAdminsException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ningún administrador';
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
