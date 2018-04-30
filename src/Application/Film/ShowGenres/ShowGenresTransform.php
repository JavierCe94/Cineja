<?php

namespace Javier\Cineja\Application\Film\ShowGenres;

use Javier\Cineja\Domain\Model\Entity\Film\Genre;

class ShowGenresTransform implements ShowGenresTransformInterface
{
    /**
     * @param array|Genre[] $genres
     * @return array
     */
    public function transform(array $genres): array
    {
        $listGenres = [];
        foreach ($genres as $genre) {
            $listGenres[] = [
                'id' => $genre->id(),
                'name' => $genre->name()
            ];
        }

        return $listGenres;
    }
}
