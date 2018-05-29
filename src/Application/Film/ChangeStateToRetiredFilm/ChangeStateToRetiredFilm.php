<?php

namespace Javier\Cineja\Application\Film\ChangeStateToRetiredFilm;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;
use Javier\Cineja\Domain\Service\Film\SearchFilmById;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class ChangeStateToRetiredFilm extends RoleAdmin
{
    private $filmRepository;
    private $changeStateToRetiredFilmTransform;
    private $searchFilmById;

    public function __construct(
        FilmRepository $filmRepository,
        ChangeStateToRetiredFilmTransformInterface $changeStateToRetiredFilmTransform,
        SearchFilmById $searchFilmById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmRepository = $filmRepository;
        $this->changeStateToRetiredFilmTransform = $changeStateToRetiredFilmTransform;
        $this->searchFilmById = $searchFilmById;
    }

    /**
     * @param ChangeStateToRetiredFilmCommand $changeStateToRetiredFilmCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms
     */
    public function handle(ChangeStateToRetiredFilmCommand $changeStateToRetiredFilmCommand): string
    {
        $film = $this->searchFilmById->execute(
            $changeStateToRetiredFilmCommand->id()
        );
        $this->filmRepository->changeToStateRetiredFilm($film);

        return $this->changeStateToRetiredFilmTransform->transform();
    }
}
