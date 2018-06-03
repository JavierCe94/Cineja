<?php

namespace Javier\Cineja\Application\Film\ShowGenres;

use Javier\Cineja\Domain\Model\Entity\Film\GenreRepository;

class ShowGenres
{
    private $genreRepository;
    private $showGenresTransform;

    public function __construct(
        GenreRepository $genreRepository,
        ShowGenresTransformI $showGenresTransform
    ) {
        $this->genreRepository = $genreRepository;
        $this->showGenresTransform = $showGenresTransform;
    }

    public function handle(): array
    {
        return $this->showGenresTransform->transform(
            $this->genreRepository->findGenres()
        );
    }
}
