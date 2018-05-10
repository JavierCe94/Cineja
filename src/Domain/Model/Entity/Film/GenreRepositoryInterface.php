<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

interface GenreRepositoryInterface
{
    public function createGenre(Genre $genre): Genre;
    public function findGenreById(int $id): ?Genre;
    public function findGenres(): array;
}
