<?php

namespace Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm;

use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilmRepository;
use Javier\Cineja\Domain\Service\FilmRoom\SearchFilmRoomById;
use Javier\Cineja\Domain\Service\Room\Seat\SearchSeatById;
use Javier\Cineja\Domain\Service\User\SearchUserById;
use Javier\Cineja\Domain\Service\UserSeatFilm\GenerateCodeQr;

class CreateUserSeatsFilm
{
    private $userSeatFilmRepository;
    private $createUserSeatsFilmTransform;
    private $searchSeatById;
    private $searchFilmRoomById;
    private $searchUserById;
    private $generateCodeQr;

    public function __construct(
        UserSeatFilmRepository $userSeatFilmRepository,
        CreateUserSeatsFilmTransformI $createUserSeatsFilmTransform,
        SearchSeatById $searchSeatById,
        SearchFilmRoomById $searchFilmRoomById,
        SearchUserById $searchUserById,
        GenerateCodeQr $generateCodeQr
    ) {
        $this->userSeatFilmRepository = $userSeatFilmRepository;
        $this->createUserSeatsFilmTransform = $createUserSeatsFilmTransform;
        $this->searchSeatById = $searchSeatById;
        $this->searchFilmRoomById = $searchFilmRoomById;
        $this->searchUserById = $searchUserById;
        $this->generateCodeQr = $generateCodeQr;
    }

    /**
     * @param CreateUserSeatsFilmCommand $createUserSeatFilmCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\FilmRoom\NotFoundFilmRoomsException
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException
     * @throws \Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException
     */
    public function handle(CreateUserSeatsFilmCommand $createUserSeatFilmCommand): string
    {
        $filmRoom = $this->searchFilmRoomById->execute(
            $createUserSeatFilmCommand->filmRoom()
        );
        $user = $this->searchUserById->execute(
            $this->dataToken()->id
        );
        $listUserSeatsFilm = [];
        foreach ($createUserSeatFilmCommand->seats() as $idSeat) {
            $seat = $this->searchSeatById->execute(
                $idSeat
            );
            $listUserSeatsFilm[] = new UserSeatFilm(
                $seat,
                $filmRoom,
                $user,
                $this->generateCodeQr->execute()
            );
        }
        $this->userSeatFilmRepository->createUserSeatFilm($listUserSeatsFilm);

        return $this->createUserSeatsFilmTransform->transform();
    }
}
