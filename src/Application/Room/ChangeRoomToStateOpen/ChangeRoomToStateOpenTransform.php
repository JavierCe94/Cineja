<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateOpen;

class ChangeRoomToStateOpenTransform implements ChangeRoomToStateOpenTransformInterface
{
    public function transform()
    {
        return 'Se ha abierto la sala con éxito';
    }
}
