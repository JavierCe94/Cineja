<?php

namespace Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre;

class CreateFilmGenreCommand
{
    private $film;
    private $genre;

    public function __construct($film, $genre)
    {
        $this->film = $film;
        $this->genre = $genre;
    }

    public function film(): int
    {
        return $this->film;
    }

    public function genre(): int
    {
        return $this->genre;
    }
}
