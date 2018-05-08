<?php

namespace Javier\Cineja\Domain\Model\Entity\Room;

class NotFoundRoomsException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna sala';
        parent::__construct($message);
    }
}
