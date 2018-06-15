<?php

namespace Javier\Cineja\Application\Film\ShowFilmsWithRooms;

interface ShowFilmsWithRoomsTransformerI
{
    public function transform(array $filmsWithRooms, \DateTime $startDate, \DateTime $endDate);
}
