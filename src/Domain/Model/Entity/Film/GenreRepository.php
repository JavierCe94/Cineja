<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

interface GenreRepository
{
    public function createGenre(Genre $genre): Genre;
    public function findGenreById(int $id): ?Genre;
    public function findGenreByName(string $name): ?Genre;
    public function findGenres(): array;
}
