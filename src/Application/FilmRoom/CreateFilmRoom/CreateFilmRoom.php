<?php

namespace Javier\Cineja\Application\FilmRoom\CreateFilmRoom;

use Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilmsException;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoomRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Domain\Services\Film\SearchFilmById;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;

class CreateFilmRoom
{
    private $filmRoomRepository;
    private $searchFilmById;
    private $searchRoomById;

    public function __construct(
        FilmRoomRepositoryInterface $filmRoomRepository,
        SearchFilmById $searchFilmById,
        SearchRoomById $searchRoomById
    ) {
        $this->filmRoomRepository = $filmRoomRepository;
        $this->searchFilmById = $searchFilmById;
        $this->searchRoomById = $searchRoomById;
    }

    public function handle(CreateFilmRoomCommand $createFilmRoomCommand): array
    {
        try {
            $film = $this->searchFilmById->execute(
                $createFilmRoomCommand->film()
            );
        } catch (NotFoundFilmsException $notFoundFilmsException) {
            return ['ko' => $notFoundFilmsException->getMessage()];
        }
        try {
            $room = $this->searchRoomById->execute(
                $createFilmRoomCommand->room()
            );
        } catch (NotFoundRoomsException $notFoundRoomsException) {
            return ['ko' => $notFoundRoomsException->getMessage()];
        }
        $filmRoom = new FilmRoom(
            $film,
            $room,
            new \DateTime(
                $createFilmRoomCommand->releaseDate()
            )
        );
        $this->filmRoomRepository->createFilmRoom($filmRoom);

        return ['ok' => 200];
    }
}
