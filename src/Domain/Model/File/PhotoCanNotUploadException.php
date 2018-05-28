<?php

namespace Javier\Cineja\Domain\Model\File;

class PhotoCanNotUploadException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha podido subir la imágen';
        $code = 404;
        parent::__construct($message, $code);
    }
}
