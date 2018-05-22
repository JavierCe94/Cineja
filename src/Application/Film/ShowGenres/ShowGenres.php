<?php

namespace Javier\Cineja\Application\Film\ShowGenres;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class ShowGenres extends RoleAdmin
{
    private $genreRepository;
    private $showGenresTransform;

    public function __construct(
        GenreRepositoryInterface $genreRepository,
        ShowGenresTransformInterface $showGenresTransform,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->genreRepository = $genreRepository;
        $this->showGenresTransform = $showGenresTransform;
    }

    /**
     * @return array
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function handle(): array
    {
        $this->checkToken();
        $listGenres = $this->genreRepository->findGenres();

        return [
            'data' => $this->showGenresTransform->transform($listGenres),
            'code' => HttpResponses::OK
        ];
    }
}
