<?php

namespace Javier\Cineja\Domain\Model\Entity\Room;

interface RoomRepository
{
    public function createRoom(Room $room): Room;
    public function changeStateRoom(Room $room, string $state): Room;
    public function findRoomById(int $id): ?Room;
    public function findRoomByName(string $name): ?Room;
    public function findRooms(): array;
}
