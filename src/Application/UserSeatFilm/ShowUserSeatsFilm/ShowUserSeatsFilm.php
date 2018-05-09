<?php

namespace Javier\Cineja\Application\UserSeatFilm\ShowUserSeatsFilm;

use Javier\Cineja\Infrastructure\Repository\UserSeatFilm\UserSeatFilmRepository;

class ShowUserSeatsFilm
{
    private $userSeatFilmRepository;
    private $showUserSeatsFilmTransform;

    public function __construct(
        UserSeatFilmRepository $userSeatFilmRepository,
        ShowUserSeatsFilmTransformInterface $showUserSeatsFilmTransform
    ) {
        $this->userSeatFilmRepository = $userSeatFilmRepository;
        $this->showUserSeatsFilmTransform = $showUserSeatsFilmTransform;
    }

    public function handle(ShowUserSeatsFilmCommand $showUserSeatsFilmCommand): array
    {

    }
}
