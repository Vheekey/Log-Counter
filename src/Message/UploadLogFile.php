<?php

namespace App\Message;

use App\Repository\LogFileRepository;
use App\Service\TextFileHandler;
use App\Service\UploadFile;

class UploadLogFile
{
    public $textFileHandler;
    public $repository;

    public function __construct(TextFileHandler $textFileHandler, LogFileRepository $repository)
    {
        $this->textFileHandler = $textFileHandler;
        $this->repository = $repository;
    }

    public function getTextFileHandler()
    {
        return $this->textFileHandler;
    }

    public function getRepository()
    {
        return $this->repository;
    }
}
