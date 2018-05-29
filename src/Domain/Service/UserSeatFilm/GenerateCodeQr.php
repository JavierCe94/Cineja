<?php

namespace Javier\Cineja\Domain\Service\UserSeatFilm;

use Javier\Cineja\Domain\Service\Util\GenerateCharacters;

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
