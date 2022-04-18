<?php
// src/Service/TextFileHandler.php

namespace App\Service;

use SplFileObject;

class TextFileHandler
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * Upload Text File
     */
    public function upload() : object
    {
        $path = $this->getTargetDirectory().'/logs.txt';

        $file = new SplFileObject($path);

        return $file;
    }

    public function getTargetDirectory() : string
    {
        return $this->targetDirectory;
    }
}