<?php

namespace Javier\Cineja\Domain\Service\Util;

class GenerateCharacters
{
    public function execute(int $numberOfCharacters): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersSize = strlen($characters) - 1;
        $generatedCharacters = '';
        for ($i = 0; $i < $numberOfCharacters; $i++) {
            $generatedCharacters .= $characters[rand(0, $charactersSize)];
        }

        return $generatedCharacters;
    }
}
