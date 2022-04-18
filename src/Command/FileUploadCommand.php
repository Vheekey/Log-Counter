<?php

namespace App\Command;

use App\Message\UploadLogFile;
use App\Repository\LogFileRepository;
use App\Service\TextFileHandler;
use App\Service\UploadFile;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:upload-file',
    description: 'Uploads a file in the background',
)]
class FileUploadCommand extends Command
{
    protected static $defaultName = 'app:upload-file';

    public $messageBus;

    public $uploadFile;

    public $logFileRepository;

    public function __construct(MessageBusInterface $messageBus, TextFileHandler $textFileHandler, LogFileRepository $logFileRepository)
    {
        parent::__construct();
        $this->messageBus = $messageBus;
        $this->logFileRepository = $logFileRepository;
        $this->textFileHandler = $textFileHandler;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        $message = new UploadLogFile($this->textFileHandler, $this->logFileRepository);

        $this->messageBus->dispatch($message);

        $io->success('File Processing!');

        return Command::SUCCESS;
    }
}
