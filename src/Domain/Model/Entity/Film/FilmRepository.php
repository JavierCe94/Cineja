<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

interface FilmRepository
{
    public function createFilm(Film $film): Film;
    public function changeToStateRetiredFilm(Film $film): Film;
    public function findFilmById(int $id): ?Film;
    public function findFilmByName(string $name): ?Film;
    public function findRoomsWhereVisualizeFilmStateVisible(\DateTime $startDate, \DateTime $endDate): array;
    public function findFilms(?\DateTime $startDate, ?\DateTime $endDate): array;
}
