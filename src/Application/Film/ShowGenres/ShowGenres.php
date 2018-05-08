<?php

namespace Javier\Cineja\Application\Film\ShowGenres;

use Javier\Cineja\Infrastructure\Repository\Film\GenreRepository;

class ShowGenres
{
    private $genreRepository;
    private $showGenresTransform;

    public function __construct(
        GenreRepository $genreRepository,
        ShowGenresTransformInterface $showGenresTransform
    ) {
        $this->genreRepository = $genreRepository;
        $this->showGenresTransform = $showGenresTransform;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        $listGenres = $this->genreRepository->findGenres();
        if (0 === count($listGenres)) {
            return ['ko' => 'No se ha encontrado ningún género'];
        }

        return $this->showGenresTransform
            ->transform($listGenres);
    }
}
