<?php

namespace Javier\Cineja\Domain\Services\FilmRoom;

use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoomRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\NotFoundFilmRoomsException;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;
use Javier\Cineja\Domain\Services\Util\Observer\Observer;

class SearchFilmRoomById implements Observer
{
    private $stateException;
    private $filmRoomRepository;

    public function __construct(FilmRoomRepositoryInterface $filmRoomRepository)
    {
        $this->stateException = false;
        $this->filmRoomRepository = $filmRoomRepository;
    }

    public function execute(int $id): FilmRoom
    {
        $filmRoom = $this->filmRoomRepository->findFilmRoomById($id);
        if (null === $filmRoom) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }

        return $filmRoom;
    }

    /**
     * @throws NotFoundFilmRoomsException
     */
    public function update()
    {
        if ($this->stateException) {
            throw new NotFoundFilmRoomsException();
        }
    }
}
