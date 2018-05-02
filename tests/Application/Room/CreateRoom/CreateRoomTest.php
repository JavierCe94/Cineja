<?php

namespace Javier\Cineja\Tests\Application\Room\CreateRoom;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Application\Room\CreateRoom\CreateRoom;
use Javier\Cineja\Application\Room\CreateRoom\CreateRoomCommand;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Infrastructure\Repository\Room\RoomRepository;
use PHPUnit\Framework\TestCase;

class CreateRoomTest extends TestCase
{
    /**
     * @test
     */
    public function create_room_then_ok_response(): void
    {
        $room = new Room('room 1', 20);
        $roomRepository = $this->getMockBuilder(RoomRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $roomRepository->method('createRoom')
            ->with($room)
            ->willReturn($room);
        $createRoom = new CreateRoom($roomRepository);
        $createRoomCommand = new CreateRoomCommand('room 1', 20);
        $createRoom->handle($createRoomCommand);
        $this->assertTrue(true, true);
    }
}
