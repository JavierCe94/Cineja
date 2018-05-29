<?php

namespace Javier\Cineja\Domain\Model\File;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhotoCanNotUploadException extends NotFoundHttpException
{
    public function __construct()
    {
        $message = 'No se ha podido subir la imágen';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
