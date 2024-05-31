<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FileProcessingService;

class ProcessDictionary extends Command
{
    /**
     * Сигнатура команды.
     *
     * @var string
     */
    protected $signature = 'dictionary:process {file : Путь к файлу словаря}';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Обработать файл словаря и организовать слова';

    /**
     * Сервис обработки файлов.
     *
     * @var FileProcessingService
     */
    protected $fileProcessingService;

    /**
     * Создание нового экземпляра команды.
     *
     * @param  FileProcessingService  $fileProcessingService
     * @return void
     */
    public function __construct(FileProcessingService $fileProcessingService)
    {
        parent::__construct();
        $this->fileProcessingService = $fileProcessingService;
    }

    /**
     * Обработать команду.
     *
     * @return int
     */
    public function handle(): int
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error('Указанный файл не существует.');
            return 1;
        }

        $this->fileProcessingService->processFile($filePath);
        $this->info('Обработка завершена.');
        return 0;
    }

}
