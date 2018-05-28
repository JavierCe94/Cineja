<?php

namespace Javier\Cineja\Application\FilmRoom\CreateFilmRoom;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoomRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Film\SearchFilmById;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;

class CreateFilmRoom extends RoleAdmin
{
    private $filmRoomRepository;
    private $searchFilmById;
    private $searchRoomById;

    public function __construct(
        FilmRoomRepositoryInterface $filmRoomRepository,
        SearchFilmById $searchFilmById,
        SearchRoomById $searchRoomById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmRoomRepository = $filmRoomRepository;
        $this->searchFilmById = $searchFilmById;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param CreateFilmRoomCommand $createFilmRoomCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     */
    public function handle(CreateFilmRoomCommand $createFilmRoomCommand): array
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

        return [
            'data' => 'Se ha creado la relación película sala con éxito',
            'code' => HttpResponses::OK
        ];
    }
}
