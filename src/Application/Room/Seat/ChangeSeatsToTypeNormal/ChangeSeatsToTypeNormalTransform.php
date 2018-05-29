<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal;

class ChangeSeatsToTypeNormalTransform implements ChangeSeatsToTypeNormalTransformInterface
{
    public function transform()
    {
        return 'Se han cambiado las butacas, al tipo normal';
    }
}
