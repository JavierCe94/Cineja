<?php

namespace Javier\Cineja\Application\FilmRoom\ShowFilmRoomsByIdAndDate;

use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoomRepository;

class ShowFilmRoomsByIdAndDate
{
    private $filmRoomRepository;
    private $showFilmRoomsByIdAndDateTransform;

    public function __construct(
        FilmRoomRepository $filmRoomRepository,
        ShowFilmRoomsByIdAndDateTransformI $showFilmRoomsByIdAndDateTransform
    ) {
        $this->filmRoomRepository = $filmRoomRepository;
        $this->showFilmRoomsByIdAndDateTransform = $showFilmRoomsByIdAndDateTransform;
    }

    public function handle(ShowFilmRoomsByIdAndDateCommand $showFilmRoomsByIdAndDateCommand): array
    {
        return $this->showFilmRoomsByIdAndDateTransform->transform(
            $this->filmRoomRepository->findFilmRoomsByIdAndDate(
                $showFilmRoomsByIdAndDateCommand->film(),
                new \DateTime($showFilmRoomsByIdAndDateCommand->date().' 00:00:00'),
                new \DateTime($showFilmRoomsByIdAndDateCommand->date().' 23:59:59')
            )
        );
    }
}
