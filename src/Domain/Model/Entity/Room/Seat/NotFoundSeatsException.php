<?php

namespace Javier\Cineja\Domain\Model\Entity\Room\Seat;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class NotFoundSeatsException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna butaca';
        parent::__construct(
            $message,
            HttpResponses::NOT_FOUND
        );
    }
}
