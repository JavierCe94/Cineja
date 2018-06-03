<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateOpen;

class ChangeRoomToStateOpenTransform implements ChangeRoomToStateOpenTransformI
{
    public function transform()
    {
        return 'Se ha abierto la sala con éxito';
    }
}
