<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class FileManagerService implements FileManagerServiceInterface
{
    private $imagePhotoDirectory;
    private $imageItemDirectory;

    public function __construct($imagePhotoDirectory, $imageItemDirectory)
    {
        $this->imagePhotoDirectory = $imagePhotoDirectory;
        $this->imageItemDirectory = $imageItemDirectory;
    }

    public function getimagePhotoDirectory()
    {
        return $this->imagePhotoDirectory;
    }

    public function getimageItemDirectory()
    {
        return $this->imageItemDirectory;
    }

    public function imagePhotoUpload(UploadedFile $file, string $dir): string
    {
        $fileName = uniqid().'.'.$file->guessExtension();
        
        if ($dir == 'user') {
            $directory = $this->getimagePhotoDirectory();
        }

        if ($dir == 'item') {
            $directory = $this->getimageItemDirectory();
        }

        try{
            $file->move($directory, $fileName);
        } catch(FileException $exception)
        {
            return $exception;
        }

        return $fileName;
    }

    public function imagePhotoRemove(string $fileName, string $dir)
    {
        $fileSystem = new Filesystem();
        if ($dir == 'user') {
            $fileImage = $this->getimagePhotoDirectory().'/'.$fileName;
        }

        if ($dir == 'item') {
            $fileImage = $this->getimageItemDirectory().'/'.$fileName;
        }

        try {
            $fileSystem->remove($fileImage);
        } catch (IOExceptionInterface $exception) {
            echo $exception->getMessage();
        }

    }
}