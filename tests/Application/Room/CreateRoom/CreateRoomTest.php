<?php

namespace Javier\Cineja\Tests\Application\Room\CreateRoom;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Application\Room\CreateRoom\CreateRoom;
use Javier\Cineja\Application\Room\CreateRoom\CreateRoomCommand;
use Javier\Cineja\Domain\Model\Entity\Room\CanNotCreateRoomException;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Infrastructure\Repository\Room\RoomRepository;
use PHPUnit\Framework\TestCase;

class CreateRoomTest extends TestCase
{
    /**
     * @test
     */
    public function create_room_then_can_not_create_exception(): void
    {
        $room = new Room('room 1', 20);

        $roomRepository = $this->getMockBuilder(RoomRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $roomRepository->method('createRoom')
            ->with($room)
            ->willThrowException(new ORMException());

        $createRoom = new CreateRoom($roomRepository);

        $this->expectException(CanNotCreateRoomException::class);

        $createRoomCommand = new CreateRoomCommand('room 1', 20);
        $createRoom->handle($createRoomCommand);
    }

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

        $this->assertArraySubset(
            [
                'ok' => 200
            ],
            $createRoom->handle($createRoomCommand)
        );
    }
}
