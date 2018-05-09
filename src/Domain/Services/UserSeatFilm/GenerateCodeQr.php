<?php

namespace Javier\Cineja\Domain\Services\UserSeatFilm;

class GenerateCodeQr
{
    public function execute(): string
    {
        $characters = 'abcdefghijklmnñopqrstuvwxyz123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ';
        $charactersSize = strlen($characters) - 1;
        $codeQr = '';
        for ($i = 0; $i < 20; $i++) {
            $codeQr .= $characters[rand(0, $charactersSize)];
        }

        return $codeQr;
    }
}
