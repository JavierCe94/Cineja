<?php

namespace Javier\Cineja\Application\FilmRoom\CreateFilmRoom;

use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoomRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Film\SearchFilmById;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;

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
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($searchFilmById);
        ListExceptions::instance()->attach($searchRoomById);
    }

    public function handle(CreateFilmRoomCommand $createFilmRoomCommand): array
    {
        $film = $this->searchFilmById->execute(
            $createFilmRoomCommand->film()
        );
        $room = $this->searchRoomById->execute(
            $createFilmRoomCommand->room()
        );
        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
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
            'code' => HttpResponses::OK
        ];
    }
}
