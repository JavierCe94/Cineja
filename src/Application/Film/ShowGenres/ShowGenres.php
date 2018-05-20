<?php

namespace Javier\Cineja\Application\Film\ShowGenres;

use Javier\Cineja\Domain\Model\Entity\Film\GenreRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class ShowGenres
{
    private $genreRepository;
    private $showGenresTransform;

    public function __construct(
        GenreRepositoryInterface $genreRepository,
        ShowGenresTransformInterface $showGenresTransform
    ) {
        $this->genreRepository = $genreRepository;
        $this->showGenresTransform = $showGenresTransform;
    }

    public function handle(): array
    {
        $listGenres = $this->genreRepository->findGenres();

        return [
            'data' => $this->showGenresTransform->transform($listGenres),
            'code' => HttpResponses::OK
        ];
    }
}
