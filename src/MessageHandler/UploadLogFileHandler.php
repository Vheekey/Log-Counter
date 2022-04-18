<?php

namespace App\MessageHandler;

use App\Message\UploadLogFile;
use App\Service\UploadFile;
use Serializable;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UploadLogFileHandler implements MessageHandlerInterface
{
    private $uploadFile;

    public function __construct(UploadFile $uploadFile)
    {
        $this->uploadFile = $uploadFile;
    }

    public function __invoke(UploadLogFile $message)
    {
        // do something with your message
        $this->uploadFile->index($message->getTextFileHandler(), $message->getRepository());
    }
}
