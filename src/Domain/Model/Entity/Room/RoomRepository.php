<?php

namespace Javier\Cineja\Domain\Model\Entity\Room;

interface RoomRepository
{
    public function createRoom(Room $room): Room;
    public function changeToStateCloseRoom(Room $room): Room;
    public function changeToStateOpenRoom(Room $room): Room;
    public function findRoomById(int $id): ?Room;
    public function findRooms(): array;
}
