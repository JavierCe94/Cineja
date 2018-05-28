<?php

namespace Javier\Cineja\Application\Film\ShowFilmsWithRooms;

use Javier\Cineja\Application\Util\Role\RoleUser;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class ShowFilmsWithRooms extends RoleUser
{
    private $filmRepository;
    private $showFilmsWithRoomsTransformer;

    public function __construct(
        FilmRepositoryInterface $filmRepository,
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

        return [
            'data' => $this->showFilmsWithRoomsTransformer->transform($filmsWithRooms),
            'code' => HttpResponses::OK
        ];
    }
}
