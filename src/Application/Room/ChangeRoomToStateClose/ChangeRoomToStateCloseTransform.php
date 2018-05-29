<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateClose;

class ChangeRoomToStateCloseTransform implements ChangeRoomToStateCloseTransformInterface
{
    public function transform()
    {
        return 'Se ha cerrado la sala con éxito';
    }
}
