<?php

namespace Javier\Cineja\Application\Film\ShowFilms;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class ShowFilms extends RoleAdmin
{
    private $filmRepository;
    private $showFilmTransform;

    public function __construct(
        FilmRepository $filmRepository,
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

        return $this->showFilmTransform->transform($films);
    }
}
