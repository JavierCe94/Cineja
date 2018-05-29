<?php

namespace Javier\Cineja\Domain\Model\Entity\Admin;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundAdminsException extends NotFoundHttpException
{
    public function __construct()
    {
        $message = 'No se ha encontrado ningún administrador';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
