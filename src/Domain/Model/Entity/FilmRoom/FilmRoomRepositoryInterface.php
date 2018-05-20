<?php

namespace Javier\Cineja\Domain\Model\Entity\FilmRoom;

interface FilmRoomRepositoryInterface
{
    public function createFilmRoom(FilmRoom $filmRoom): FilmRoom;
    public function findFilmRoomById(int $id): ?FilmRoom;
    public function findFilmRooms(int $idFilm): array;
}
