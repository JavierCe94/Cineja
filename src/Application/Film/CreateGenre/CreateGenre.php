<?php

namespace Javier\Cineja\Application\Film\CreateGenre;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class CreateGenre extends RoleAdmin
{
    private $genreRepository;

    public function __construct(
        GenreRepositoryInterface $genreRepository,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->genreRepository = $genreRepository;
    }

    /**
     * @param CreateGenreCommand $createGenreCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function handle(CreateGenreCommand $createGenreCommand): array
    {
        $this->checkToken();
        $genre = new Genre(
            $createGenreCommand->name()
        );
        $this->genreRepository->createGenre($genre);

        return [
            'data' => 'Se ha creado el género con éxito',
            'code' => HttpResponses::OK_CREATED
        ];
    }
}
