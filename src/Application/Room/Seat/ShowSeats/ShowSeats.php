<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeats;

use Javier\Cineja\Infrastructure\Repository\Room\Seat\SeatRepository;

class ShowSeats
{
    private $seatRepository;
    private $showSeatsTransform;

    public function __construct(
        SeatRepository $seatRepository,
        ShowSeatsTransformInterface $showSeatsTransform
    ) {
        $this->seatRepository = $seatRepository;
        $this->showSeatsTransform = $showSeatsTransform;
    }

    public function handle(ShowSeatsCommand $showSeatsCommand): array
    {
        $seats = $this->seatRepository->findSeatsByIdRoom(
            $showSeatsCommand->room()
        );
        if (0 === count($seats)) {
            return ['ko' => 'No se ha encontrado ningún asiento'];
        }

        return $this->showSeatsTransform
            ->transform($seats);
    }
}
