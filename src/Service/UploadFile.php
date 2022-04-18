<?php
// src/Service/UploadFile.php

namespace App\Service;

use App\Entity\LogFile;
use App\Repository\LogFileRepository;
use DateTime;
use Symfony\Component\Messenger\MessageBus;

class UploadFile
{
    public function index(TextFileHandler $textFileHandler, LogFileRepository $repository)
    {
        $file = $textFileHandler->upload();

        while (!$file->eof()) {
            $record = $file->fgets();
            $record = str_replace(' - - ', ' ', $record);
            $record = str_replace('[', '', $record);
            $record = explode(' ', $record);

            $date = explode(':', $record[1]);
            $string = $date[0].' '.$date[1].':'.$date[2].':'.$date[3];
            $dateTime = DateTime::createFromFormat('d/M/Y H:i:s', $string);

            $log = new LogFile();

            $log->setServiceName(trim($record[0]));
            $log->setDate($dateTime);
            $log->setMethod(trim(str_replace('"','',$record[3])));
            $log->setEndpoint(trim($record[4]));
            $log->setStatusCode(trim($record[6]));

            $repository->add($log);
        }
    }
}