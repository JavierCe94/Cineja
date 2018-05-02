<?php

namespace Javier\Cineja\Tests\Application\Room\Seat\CreateSeats;

use Javier\Cineja\Application\Room\Seat\CreateSeatsRoom\CreateSeatsRoom;
use Javier\Cineja\Application\Room\Seat\CreateSeatsRoom\CreateSeatsRoomCommand;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Infrastructure\Repository\Room\RoomRepository;
use Javier\Cineja\Infrastructure\Repository\Room\Seat\SeatRepository;
use PHPUnit\Framework\TestCase;

class CreateSeatsTest extends TestCase
{
    /**
     * @test
     */
    public function create_seats_then_ok_response(): void
    {
        $idRoom = 1;
        $priceSeat = 7.2;
        $totalSeats = 20;
        $room = $this->getMockBuilder(Room::class)
            ->disableOriginalConstructor()
            ->getMock();
        $room->method('id')
            ->willReturn(1);
        $room->method('name')
            ->willReturn('Room 1');
        $room->method('totalSeatsByRow')
            ->willReturn($totalSeats);
        $room->method('stateRoom')
            ->willReturn('OPEN');
        $listSeats = [];
        for ($i = 0; $i < $totalSeats; $i++) {
            $listSeats[] = new Seat($room, $priceSeat);
        }
        $roomRepository = $this->getMockBuilder(RoomRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $roomRepository->method('findByIdRoom')
            ->with($idRoom)
            ->willReturn($room);
        $seatRepository = $this->getMockBuilder(SeatRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $seatRepository->method('createSeatsRoom')
            ->with($listSeats);
        $createSeatsRoom = new CreateSeatsRoom($seatRepository, $roomRepository);
        $createSeatsRoomCommand = new CreateSeatsRoomCommand($idRoom, $priceSeat, $totalSeats);
        $createSeatsRoom->handle($createSeatsRoomCommand);
        $this->assertTrue(true, true);
    }
}
