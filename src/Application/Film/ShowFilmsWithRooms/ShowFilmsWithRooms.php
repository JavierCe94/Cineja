<?php

namespace Javier\Cineja\Application\Film\ShowFilmsWithRooms;

use Javier\Cineja\Application\Util\Role\RoleUser;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class ShowFilmsWithRooms extends RoleUser
{
    private $filmRepository;
    private $showFilmsWithRoomsTransformer;

    public function __construct(
        FilmRepository $filmRepository,
        ShowFilmsWithRoomsTransformerInterface $showFilmsWithRoomsTransformer,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmRepository = $filmRepository;
        $this->showFilmsWithRoomsTransformer = $showFilmsWithRoomsTransformer;
    }

    public function handle(): array
    {
        $filmsWithRooms = $this->filmRepository->findRoomsWhereVisualizeFilmStateVisible();

        return $this->showFilmsWithRoomsTransformer->transform($filmsWithRooms);
    }
}
