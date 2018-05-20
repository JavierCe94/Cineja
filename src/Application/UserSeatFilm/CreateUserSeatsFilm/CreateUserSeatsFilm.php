<?php

namespace Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm;

use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\FilmRoom\SearchFilmRoomById;
use Javier\Cineja\Domain\Services\Room\Seat\SearchSeatById;
use Javier\Cineja\Domain\Services\User\SearchUserById;
use Javier\Cineja\Domain\Services\UserSeatFilm\GenerateCodeQr;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;

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
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($searchFilmRoomById);
        ListExceptions::instance()->attach($searchUserById);
        ListExceptions::instance()->attach($searchSeatById);
    }

    public function handle(CreateUserSeatsFilmCommand $createUserSeatFilmCommand): array
    {
        $filmRoom = $this->searchFilmRoomById->execute(
            $createUserSeatFilmCommand->filmRoom()
        );
        $user = $this->searchUserById->execute(
            $createUserSeatFilmCommand->user()
        );
        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
        }
        $listUserSeatsFilm = [];
        foreach ($createUserSeatFilmCommand->seats() as $idSeat) {
            $seat = $this->searchSeatById->execute(
                $idSeat
            );
            if (ListExceptions::instance()->checkForExceptions()) {
                return ListExceptions::instance()->firstException();
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
            'code' => HttpResponses::OK_CREATED
        ];
    }
}
