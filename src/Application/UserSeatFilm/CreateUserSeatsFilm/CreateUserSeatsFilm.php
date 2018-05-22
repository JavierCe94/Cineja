<?php

namespace Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm;

use Javier\Cineja\Application\Util\Role\RoleUser;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\FilmRoom\SearchFilmRoomById;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;
use Javier\Cineja\Domain\Services\Room\Seat\SearchSeatById;
use Javier\Cineja\Domain\Services\User\SearchUserById;
use Javier\Cineja\Domain\Services\UserSeatFilm\GenerateCodeQr;

class CreateUserSeatsFilm extends RoleUser
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
        GenerateCodeQr $generateCodeQr,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->userSeatFilmRepository = $userSeatFilmRepository;
        $this->searchSeatById = $searchSeatById;
        $this->searchFilmRoomById = $searchFilmRoomById;
        $this->searchUserById = $searchUserById;
        $this->generateCodeQr = $generateCodeQr;
    }

    /**
     * @param CreateUserSeatsFilmCommand $createUserSeatFilmCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\FilmRoom\NotFoundFilmRoomsException
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException
     * @throws \Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function handle(CreateUserSeatsFilmCommand $createUserSeatFilmCommand): array
    {
        $token = $this->checkToken();
        $filmRoom = $this->searchFilmRoomById->execute(
            $createUserSeatFilmCommand->filmRoom()
        );
        $user = $this->searchUserById->execute(
            $token->id
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

        return [
            'data' => 'Se ha creado la relación usuario asiento película con éxito',
            'code' => HttpResponses::OK_CREATED
        ];
    }
}
