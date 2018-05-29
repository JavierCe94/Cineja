<?php

namespace Javier\Cineja\Domain\Model\Entity\Room\Seat;

interface SeatRepository
{
    public function createSeatsRoom(array $seats): array;
    public function changeToTypeSpaceSeat(array $seats): array;
    public function changeToTypeNormalSeat(array $seats): array;
    public function findSeatById(int $id): ?Seat;
    public function findSeatsFilmRoom(int $idRoom, int $idFilmRoom): array;
    public function findSeatsByIdRoom(int $idRoom): array;
}
