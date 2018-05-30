<?php

namespace Javier\Cineja\Application\FilmRoom\CreateFilmRoom;

use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoomRepository;
use Javier\Cineja\Domain\Service\Film\SearchFilmById;
use Javier\Cineja\Domain\Service\Room\SearchRoomById;

class CreateFilmRoom
{
    private $filmRoomRepository;
    private $createFilmRoomTransform;
    private $searchFilmById;
    private $searchRoomById;

    public function __construct(
        FilmRoomRepository $filmRoomRepository,
        CreateFilmRoomTransformInterface $createFilmRoomTransform,
        SearchFilmById $searchFilmById,
        SearchRoomById $searchRoomById
    ) {
        $this->filmRoomRepository = $filmRoomRepository;
        $this->createFilmRoomTransform = $createFilmRoomTransform;
        $this->searchFilmById = $searchFilmById;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param CreateFilmRoomCommand $createFilmRoomCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     */
    public function handle(CreateFilmRoomCommand $createFilmRoomCommand): string
    {
        $this->filmRoomRepository->createFilmRoom(
            new FilmRoom(
                $this->searchFilmById->execute(
                    $createFilmRoomCommand->film()
                ),
                $this->searchRoomById->execute(
                    $createFilmRoomCommand->room()
                ),
                new \DateTime(
                    $createFilmRoomCommand->releaseDate()
                )
            )
        );

        return $this->createFilmRoomTransform->transform();
    }
}
