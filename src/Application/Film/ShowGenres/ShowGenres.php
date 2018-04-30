<?php

namespace Javier\Cineja\Application\Film\ShowGenres;

use Javier\Cineja\Domain\Model\Entity\Film\NotFoundGenresException;
use Javier\Cineja\Infrastructure\Repository\Film\GenreRepository;

class ShowGenres
{
    private $genreRepository;
    private $showGenresTransform;

    public function __construct(GenreRepository $genreRepository, ShowGenresTransformInterface $showGenresTransform)
    {
        $this->genreRepository = $genreRepository;
        $this->showGenresTransform = $showGenresTransform;
    }

    /**
     * @return array
     * @throws NotFoundGenresException
     */
    public function handle(): array
    {
        $listGenres = $this->genreRepository->showGenres();

        if (0 === count($listGenres)) {
            throw new NotFoundGenresException('No se ha encontrado ningún género');
        }

        return $this->showGenresTransform
            ->transform($listGenres);
    }
}
