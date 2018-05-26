<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

class CreateFilmCommand
{
    private $image;
    private $name;
    private $description;
    private $duration;
    private $minAge;

    public function __construct($image, $name, $description, $duration, $minAge)
    {
        $this->image = $image;
        $this->name = $name;
        $this->description = $description;
        $this->duration = $duration;
        $this->minAge = $minAge;
    }

    public function image()
    {
        return $this->image;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function duration(): int
    {
        return $this->duration;
    }

    public function minAge(): int
    {
        return $this->minAge;
    }
}
