<?php

namespace Javier\Cineja\Application\Film\ShowFilmsWithRooms;

use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;

class ShowFilmsWithRooms
{
    private $filmRepository;
    private $showFilmsWithRoomsTransformer;

    public function __construct(
        FilmRepositoryInterface $filmRepository,
        ShowFilmsWithRoomsTransformerInterface $showFilmsWithRoomsTransformer
    ) {
        $this->filmRepository = $filmRepository;
        $this->showFilmsWithRoomsTransformer = $showFilmsWithRoomsTransformer;
    }

    public function handle(): array
    {
        $filmsWithRooms = $this->filmRepository->findRoomsWhereVisualizeFilmStateVisible();

        return $this->showFilmsWithRoomsTransformer
            ->transform($filmsWithRooms);
    }
}
