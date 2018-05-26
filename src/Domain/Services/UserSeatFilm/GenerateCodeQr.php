<?php

namespace Javier\Cineja\Domain\Services\UserSeatFilm;

use Javier\Cineja\Domain\Services\Util\GenerateCharacters;

class GenerateCodeQr
{
    private $generateCharacters;

    public function __construct(GenerateCharacters $generateCharacters)
    {
        $this->generateCharacters = $generateCharacters;
    }

    public function execute(): string
    {
        $numberOfCharacters = 20;
        return $this->generateCharacters->execute($numberOfCharacters);
    }
}
