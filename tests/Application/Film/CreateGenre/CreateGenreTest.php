<?php

namespace Javier\Cineja\Tests\Application\Film\CreateGenre;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Application\Film\CreateGenre\CreateGenre;
use Javier\Cineja\Application\Film\CreateGenre\CreateGenreCommand;
use Javier\Cineja\Domain\Model\Entity\Film\CanNotCreateGenreException;
use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Infrastructure\Repository\Film\GenreRepository;
use PHPUnit\Framework\TestCase;

class CreateGenreTest extends TestCase
{
    /**
     * @test
     */
    public function create_genre_then_can_not_create_exception(): void
    {
        $genre = new Genre('acción');

        $genreRepository = $this->getMockBuilder(GenreRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $genreRepository->method('createGenre')
            ->with($genre)
            ->willThrowException(new ORMException());
        
        $createGenre = new CreateGenre($genreRepository);
        $createGenreCommand = new CreateGenreCommand('acción');
        
        $this->expectException(CanNotCreateGenreException::class);

        $createGenre->handle($createGenreCommand);
    }

    /**
     * @test
     */
    public function create_genre_then_ok_response(): void
    {
        $genre = new Genre('acción');

        $genreRepository = $this->getMockBuilder(GenreRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $genreRepository->method('createGenre')
            ->with($genre)
            ->willReturn($genre);

        $createGenre = new CreateGenre($genreRepository);
        $createGenreCommand = new CreateGenreCommand('acción');

        $this->assertArraySubset(
            [
                'ok' => 200
            ],
            $createGenre->handle($createGenreCommand)
        );
    }
}
