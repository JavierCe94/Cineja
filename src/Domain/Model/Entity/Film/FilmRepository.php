<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

interface FilmRepository
{
    public function createFilm(Film $film): Film;
    public function changeToStateRetiredFilm(Film $film): Film;
    public function findFilmById(int $id): ?Film;
    public function findRoomsWhereVisualizeFilmStateVisible(): array;
    public function findFilms(): array;
}
