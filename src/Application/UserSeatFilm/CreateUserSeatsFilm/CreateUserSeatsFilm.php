<?php

namespace Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm;

use Javier\Cineja\Domain\Model\Entity\FilmRoom\NotFoundFilmRoomsException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException;
use Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilmRepositoryInterface;
use Javier\Cineja\Domain\Services\FilmRoom\SearchFilmRoomById;
use Javier\Cineja\Domain\Services\Room\Seat\SearchSeatById;
use Javier\Cineja\Domain\Services\User\SearchUserById;
use Javier\Cineja\Domain\Services\UserSeatFilm\GenerateCodeQr;

class CreateUserSeatsFilm
{
    private $userSeatFilmRepository;
    private $searchSeatById;
    private $searchFilmRoomById;
    private $searchUserById;
    private $generateCodeQr;

    public function __construct(
        UserSeatFilmRepositoryInterface $userSeatFilmRepository,
        SearchSeatById $searchSeatById,
        SearchFilmRoomById $searchFilmRoomById,
        SearchUserById $searchUserById,
        GenerateCodeQr $generateCodeQr
    ) {
        $this->userSeatFilmRepository = $userSeatFilmRepository;
        $this->searchSeatById = $searchSeatById;
        $this->searchFilmRoomById = $searchFilmRoomById;
        $this->searchUserById = $searchUserById;
        $this->generateCodeQr = $generateCodeQr;
    }

    public function handle(CreateUserSeatsFilmCommand $createUserSeatFilmCommand): array
    {
        try {
            $filmRoom = $this->searchFilmRoomById->execute(
                $createUserSeatFilmCommand->filmRoom()
            );
        } catch (NotFoundFilmRoomsException $notFoundFilmRoomsException) {
            return [
                'data' => $notFoundFilmRoomsException->getMessage(),
                'code' => $notFoundFilmRoomsException->getCode()
            ];
        }
        try {
            $user = $this->searchUserById->execute(
                $createUserSeatFilmCommand->user()
            );
        } catch (NotFoundUsersException $notFoundUsersException) {
            return [
                'data' => $notFoundUsersException->getMessage(),
                'code' => $notFoundUsersException->getCode()
            ];
        }
        $listUserSeatsFilm = [];
        foreach ($createUserSeatFilmCommand->seats() as $idSeat) {
            try {
                $seat = $this->searchSeatById->execute(
                    $idSeat
                );
            } catch (NotFoundSeatsException $notFoundSeatsException) {
                return [
                    'data' => $notFoundSeatsException->getMessage(),
                    'code' => $notFoundSeatsException->getCode()
                ];
            }
            $listUserSeatsFilm[] = new UserSeatFilm(
                $seat,
                $filmRoom,
                $user,
                $this->generateCodeQr->execute()
            );
        }
        $this->userSeatFilmRepository->createUserSeatFilm($listUserSeatsFilm);

        return [
            'data' => 'Se ha creado la relación usuario asiento película con éxito',
            'code' => 200
        ];
    }
}
