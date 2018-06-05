<?php

namespace Javier\Cineja\Application\Film\ShowFilmById;

use Javier\Cineja\Domain\Service\Film\SearchFilmById;

class ShowFilmById
{
    private $searchFilmById;
    private $showFilmByIdTransform;

    public function __construct(
        SearchFilmById $searchFilmById,
        ShowFilmByIdTransformI $showFilmByIdTransform
    ) {
        $this->searchFilmById = $searchFilmById;
        $this->showFilmByIdTransform = $showFilmByIdTransform;
    }

    /**
     * @param ShowFilmByIdCommand $showFilmByIdCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms
     */
    public function handle(ShowFilmByIdCommand $showFilmByIdCommand): array
    {
        return $this->showFilmByIdTransform->transform(
            $this->searchFilmById->execute(
                $showFilmByIdCommand->id()
            )
        );
    }
}
