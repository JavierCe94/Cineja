<?php

namespace Javier\Cineja\Application\Film\ShowFilms;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class ShowFilms extends RoleAdmin
{
    private $filmRepository;
    private $showFilmTransform;

    public function __construct(
        FilmRepositoryInterface $filmRepository,
        ShowFilmsTransformInterface $showFilmTransform,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmRepository = $filmRepository;
        $this->showFilmTransform = $showFilmTransform;
    }

    public function handle(): array
    {
        $films = $this->filmRepository->findFilms();

        return [
            'data' => $this->showFilmTransform->transform($films),
            'code' => HttpResponses::OK
        ];
    }
}
