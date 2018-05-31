<?php

namespace Javier\Cineja\Domain\Model\File;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class PhotoCanNotUploadException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha podido subir la imágen';
        parent::__construct(
            $message,
            HttpResponses::NOT_FOUND
        );
    }
}
