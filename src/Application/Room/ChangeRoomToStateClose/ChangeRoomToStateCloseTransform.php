<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateClose;

class ChangeRoomToStateCloseTransform implements ChangeRoomToStateCloseTransformI
{
    public function transform()
    {
        return 'Se ha cerrado la sala con éxito';
    }
}
