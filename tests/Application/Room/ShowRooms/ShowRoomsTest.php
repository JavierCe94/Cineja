<?php

namespace Javier\Cineja\Tests\Application\Room\ShowRooms;

use Javier\Cineja\Application\Room\ShowRooms\ShowRooms;
use Javier\Cineja\Application\Room\ShowRooms\ShowRoomsTransform;
use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Infrastructure\Repository\Room\RoomRepository;
use PHPUnit\Framework\TestCase;

class ShowRoomsTest extends TestCase
{
    /**
     * @test
     */
    public function given_rooms_when_request_then_not_found_exception(): void
    {
        $roomRepository = $this->getMockBuilder(RoomRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $roomRepository->method('showRooms')
            ->willReturn([]);
        $showRoomsTransform = new ShowRoomsTransform();
        $showRooms = new ShowRooms($roomRepository, $showRoomsTransform);
        $this->expectException(NotFoundRoomsException::class);
        $showRooms->handle();
    }

    /**
     * @test
     */
    public function given_rooms_when_request_then_show(): void
    {
        $room = $this->getMockBuilder(Room::class)
            ->disableOriginalConstructor()
            ->getMock();
        $room->method('id')
            ->willReturn(1);
        $room->method('name')
            ->willReturn('Room 1');
        $room->method('totalSeatsByRow')
            ->willReturn(20);
        $roomRepository = $this->getMockBuilder(RoomRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $roomRepository->method('showRooms')
            ->willReturn([$room]);
        $showRoomsTransform = new ShowRoomsTransform();
        $showRooms = new ShowRooms($roomRepository, $showRoomsTransform);
        $this->assertArraySubset(
            [
                0 => [
                    'id' => 1,
                    'name' => 'Room 1'
                ]
            ],
            $showRooms->handle()
        );
    }
}
