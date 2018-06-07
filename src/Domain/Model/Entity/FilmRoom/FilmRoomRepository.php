<?php

namespace Javier\Cineja\Domain\Model\Entity\FilmRoom;

interface FilmRoomRepository
{
    public function createFilmRoom(FilmRoom $filmRoom): FilmRoom;
    public function findFilmRoomById(int $id): ?FilmRoom;
    public function findFilmRoomsByIdAndDate(int $idFilm, \DateTime $startDate, \DateTime $endDate): array;
}
