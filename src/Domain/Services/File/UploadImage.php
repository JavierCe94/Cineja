<?php

namespace Javier\Cineja\Domain\Services\File;

use Javier\Cineja\Domain\Services\Util\GenerateCharacters;

class UploadImage
{
    private $generateCharacters;

    public function __construct(GenerateCharacters $generateCharacters)
    {
        $this->generateCharacters = $generateCharacters;
    }

    public function execute($fileImage, string $urlFilm): string
    {
        $numberOfCharacters = 20;
        $generatedName = $this->generateCharacters->execute($numberOfCharacters);
        $filmImageName = $generatedName.'.'.$this->extensionImage($fileImage);
        list($width, $height) = getimagesize($fileImage['tmp_name']);
        $tn = imagecreatetruecolor($width, $height);
        if ('image/png' === $fileImage['type']) {
            $image = imageCreateFromPng($fileImage['tmp_name']);
        } else {
            $image = imageCreateFromJpeg($fileImage['tmp_name']);
        }
        imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height);
        $url = __DIR__.'/../../../../public/uploads/'.$urlFilm.$filmImageName;
        if ('image/png' === $fileImage["type"]) {
            imagepng($tn, $url);
        } else {
            imagejpeg($tn, $url, 100);
        }

        return $filmImageName;
    }

    private function extensionImage($fileImage): string
    {
        $extension = "jpg";
        if ('image/png' === $fileImage['type']) {
            $extension = "png";
        }

        return $extension;
    }
}
