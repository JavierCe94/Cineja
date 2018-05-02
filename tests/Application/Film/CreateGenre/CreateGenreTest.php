<?php

namespace Javier\Cineja\Tests\Application\Film\CreateGenre;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Application\Film\CreateGenre\CreateGenre;
use Javier\Cineja\Application\Film\CreateGenre\CreateGenreCommand;
use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Infrastructure\Repository\Film\GenreRepository;
use PHPUnit\Framework\TestCase;

class CreateGenreTest extends TestCase
{
    /**
     * @test
     */
    public function create_genre_then_ok_response(): void
    {
        $genre = new Genre('action');
        $genreRepository = $this->getMockBuilder(GenreRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $genreRepository->method('createGenre')
            ->with($genre)
            ->willReturn($genre);
        $createGenre = new CreateGenre($genreRepository);
        $createGenreCommand = new CreateGenreCommand('action');
        $createGenre->handle($createGenreCommand);
        $this->assertTrue(true, true);
    }
}
