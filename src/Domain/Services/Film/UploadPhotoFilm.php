<?php

namespace Javier\Cineja\Domain\Services\Film;

use Javier\Cineja\Domain\Services\Util\GenerateCharacters;

class UploadPhotoFilm
{
    private $generateCharacters;

    public function __construct(GenerateCharacters $generateCharacters)
    {
        $this->generateCharacters = $generateCharacters;
    }

    public function execute($filmImage): string
    {
        $numberOfCharacters = 10;
        $generatedName = $this->generateCharacters->execute($numberOfCharacters);
        $filmImageName = $generatedName.'.'.$this->extensionImage($filmImage);
        list($width, $height) = getimagesize($filmImage['tmp_name']);
        $tn = imagecreatetruecolor($width, $height);
        if ('image/png' === $filmImage['type']) {
            $image = imageCreateFromPng($filmImage['tmp_name']);
        } else {
            $image = imageCreateFromJpeg($filmImage['tmp_name']);
        }
        imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height);
        $url = __DIR__.'/../../../../public/uploads/films/'.$filmImageName;
        if ('image/png' === $filmImage["type"]) {
            imagepng($tn, $url);
        } else {
            imagejpeg($tn, $url, 100);
        }

        return $filmImageName;
    }

    private function extensionImage($filmImage): string
    {
        $extension = "jpg";
        if ('image/png' === $filmImage['type']) {
            $extension = "png";
        }

        return $extension;
    }
}
