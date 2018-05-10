<?php

namespace Javier\Cineja\Domain\Model\Entity\Film\FilmGenre;

interface FilmGenreRepositoryInterface
{
    public function createFilmGenre(FilmGenre $filmGenre): FilmGenre;
    public function findFilmsGenresWithStateVisible(string $stateFilm): array;
}
