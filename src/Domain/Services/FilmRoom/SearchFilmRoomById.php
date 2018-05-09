<?php

namespace Javier\Cineja\Domain\Services\FilmRoom;

use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\NotFoundFilmRoomsException;
use Javier\Cineja\Infrastructure\Repository\FilmRoom\FilmRoomRepository;

class SearchFilmRoomById
{
    private $filmRoomRepository;

    public function __construct(FilmRoomRepository $filmRoomRepository)
    {
        $this->filmRoomRepository = $filmRoomRepository;
    }

    /**
     * @param int $id
     * @return FilmRoom
     * @throws NotFoundFilmRoomsException
     */
    public function execute(int $id): FilmRoom
    {
        $filmRoom = $this->filmRoomRepository->findFilmRoomById($id);
        if (null === $filmRoom) {
            throw new NotFoundFilmRoomsException();
        }

        return $filmRoom;
    }
}
