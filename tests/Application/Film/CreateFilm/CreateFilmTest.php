<?php

namespace Javier\Cineja\Tests\Application\Film\CreateFilm;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Application\Film\CreateFilm\CreateFilm;
use Javier\Cineja\Application\Film\CreateFilm\CreateFilmCommand;
use Javier\Cineja\Domain\Model\Entity\Film\CanNotCreateFilmException;
use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Infrastructure\Repository\Film\FilmRepository;
use PHPUnit\Framework\TestCase;

class CreateFilmTest extends TestCase
{
    /**
     * @test
     */
    public function create_film_then_can_not_create_exception(): void
    {
        $film = new Film(
            'image.png',
            'name',
            'description',
            'description',
            120,
            12
        );

        $filmRepository = $this->getMockBuilder(FilmRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $filmRepository->method('createFilm')
            ->with($film)
            ->willThrowException(new ORMException());

        $createFilm = new CreateFilm($filmRepository);

        $createFilmCommand = new CreateFilmCommand(
            'image.png',
            'name',
            'description',
            120,
            12
        );

        $this->expectException(CanNotCreateFilmException::class);

        $createFilm->handle($createFilmCommand);
    }

    /**
     * @test
     */
    public function create_film_then_ok_response(): void
    {
        $film = new Film(
            'image.png',
            'name',
            'description',
            'description',
            120,
            12
        );

        $filmRepository = $this->getMockBuilder(FilmRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $filmRepository->method('createFilm')
            ->with($film)
            ->willReturn($film);

        $createFilm = new CreateFilm($filmRepository);

        $createFilmCommand = new CreateFilmCommand(
            'image.png',
            'name',
            'description',
            120,
            12
        );

        $this->assertArraySubset(
            [
                'ok' => 200
            ],
            $createFilm->handle($createFilmCommand)
        );
    }
}
