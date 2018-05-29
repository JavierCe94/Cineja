<?php

namespace Javier\Cineja\Application\Film\CreateGenre;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class CreateGenre extends RoleAdmin
{
    private $genreRepository;
    private $createGenreTransform;

    public function __construct(
        GenreRepository $genreRepository,
        CreateGenreTransformInterface $createGenreTransform,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->genreRepository = $genreRepository;
        $this->createGenreTransform = $createGenreTransform;
    }

    public function handle(CreateGenreCommand $createGenreCommand): string
    {
        $genre = new Genre(
            $createGenreCommand->name()
        );
        $this->genreRepository->createGenre($genre);

        return $this->createGenreTransform->transform();
    }
}
