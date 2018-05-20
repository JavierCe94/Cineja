<?php

namespace Javier\Cineja\Domain\Model\Entity\Room;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class NotFoundRoomsException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna sala';
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
