<?php

namespace Javier\Cineja\Domain\Model\Entity\Film\FilmGenre;

interface FilmGenreRepository
{
    public function createFilmGenre(FilmGenre $filmGenre): FilmGenre;
    public function findFilmsGenresWithStateVisible(string $stateFilm): array;
}
