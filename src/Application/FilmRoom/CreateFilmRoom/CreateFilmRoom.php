<?php

namespace Javier\Cineja\Application\FilmRoom\CreateFilmRoom;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoomRepository;
use Javier\Cineja\Domain\Service\Film\SearchFilmById;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;
use Javier\Cineja\Domain\Service\Room\SearchRoomById;

class CreateFilmRoom extends RoleAdmin
{
    private $filmRoomRepository;
    private $createFilmRoomTransform;
    private $searchFilmById;
    private $searchRoomById;

    public function __construct(
        FilmRoomRepository $filmRoomRepository,
        CreateFilmRoomTransformInterface $createFilmRoomTransform,
        SearchFilmById $searchFilmById,
        SearchRoomById $searchRoomById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
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
        $film = $this->searchFilmById->execute(
            $createFilmRoomCommand->film()
        );
        $room = $this->searchRoomById->execute(
            $createFilmRoomCommand->room()
        );
        $filmRoom = new FilmRoom(
            $film,
            $room,
            new \DateTime(
                $createFilmRoomCommand->releaseDate()
            )
        );
        $this->filmRoomRepository->createFilmRoom($filmRoom);

        return $this->createFilmRoomTransform->transform();
    }
}
