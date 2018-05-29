<?php

namespace Javier\Cineja\Application\Film\ShowGenres;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class ShowGenres extends RoleAdmin
{
    private $genreRepository;
    private $showGenresTransform;

    public function __construct(
        GenreRepository $genreRepository,
        ShowGenresTransformInterface $showGenresTransform,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->genreRepository = $genreRepository;
        $this->showGenresTransform = $showGenresTransform;
    }

    public function handle(): array
    {
        $listGenres = $this->genreRepository->findGenres();

        return $this->showGenresTransform->transform($listGenres);
    }
}
