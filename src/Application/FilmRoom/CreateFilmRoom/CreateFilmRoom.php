<?php

namespace Javier\Cineja\Application\FilmRoom\CreateFilmRoom;

use Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms;
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
        } catch (NotFoundFilms $notFoundFilmsException) {
            return [
                'data' => $notFoundFilmsException->getMessage(),
                'code' => $notFoundFilmsException->getCode()
            ];
        }
        try {
            $room = $this->searchRoomById->execute(
                $createFilmRoomCommand->room()
            );
        } catch (NotFoundRoomsException $notFoundRoomsException) {
            return [
                'data' => $notFoundRoomsException->getMessage(),
                'code' => $notFoundRoomsException->getCode()
            ];
        }
        $filmRoom = new FilmRoom(
            $film,
            $room,
            new \DateTime(
                $createFilmRoomCommand->releaseDate()
            )
        );
        $this->filmRoomRepository->createFilmRoom($filmRoom);

        return [
            'data' => 'Se ha creado la relación película sala con éxito',
            'code' => 200
        ];
    }
}
