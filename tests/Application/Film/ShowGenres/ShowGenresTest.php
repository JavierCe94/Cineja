<?php

namespace Javier\Cineja\Tests\Application\Film\ShowGenres;

use Javier\Cineja\Application\Film\ShowGenres\ShowGenres;
use Javier\Cineja\Application\Film\ShowGenres\ShowGenresTransform;
use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundGenresException;
use Javier\Cineja\Infrastructure\Repository\Film\GenreRepository;
use PHPUnit\Framework\TestCase;

class ShowGenresTest extends TestCase
{
    /**
     * @test
     */
    public function given_genres_when_request_then_not_found_exception(): void
    {
        $genreRepository = $this->getMockBuilder(GenreRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $genreRepository->method('showGenres')
            ->willReturn([]);
        $showGenresTransform = new ShowGenresTransform();
        $showGenres = new ShowGenres($genreRepository, $showGenresTransform);
        $this->expectException(NotFoundGenresException::class);
        $showGenres->handle();
    }

    /**
     * @test
     */
    public function given_genres_when_request_then_show(): void
    {
        $genre = $this->getMockBuilder(Genre::class)
            ->disableOriginalConstructor()
            ->getMock();
        $genre->method('id')
            ->willReturn(1);
        $genre->method('name')
            ->willReturn('acción');
        $genreRepository = $this->getMockBuilder(GenreRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $genreRepository->method('showGenres')
            ->willReturn([$genre]);
        $showGenresTransform = new ShowGenresTransform();
        $showGenres = new ShowGenres($genreRepository, $showGenresTransform);
        $this->assertArraySubset(
            [
                0 => [
                    'id' => 1,
                    'name' => 'acción'
                ]
            ],
            $showGenres->handle()
        );
    }
}
