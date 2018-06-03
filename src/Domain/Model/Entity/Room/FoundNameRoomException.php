<?php

namespace Javier\Cineja\Domain\Model\Entity\Room;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class FoundNameRoomException extends \Exception
{
    public function __construct()
    {
        $message = 'El nombre de la sala introducida ya existe';
        parent::__construct(
            $message,
            HttpResponses::CONFLICT_SEARCH
        );
    }
}
