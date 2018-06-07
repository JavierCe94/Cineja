<?php

namespace Javier\Cineja\Application\Film\ShowFilmsWithRooms;

use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;

class ShowFilmsWithRooms
{
    private $filmRepository;
    private $showFilmsWithRoomsTransformer;

    public function __construct(
        FilmRepository $filmRepository,
        ShowFilmsWithRoomsTransformerI $showFilmsWithRoomsTransformer
    ) {
        $this->filmRepository = $filmRepository;
        $this->showFilmsWithRoomsTransformer = $showFilmsWithRoomsTransformer;
    }

    public function handle(ShowFilmsWithRoomsCommand $showFilmsWithRoomsCommand): array
    {
        return $this->showFilmsWithRoomsTransformer->transform(
            $this->filmRepository->findRoomsWhereVisualizeFilmStateVisible(
                new \DateTime($showFilmsWithRoomsCommand->date().' 00:00:00'),
                new \DateTime($showFilmsWithRoomsCommand->date().' 23:59:59')
            )
        );
    }
}
