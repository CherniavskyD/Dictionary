<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class FileProcessingService
{
    /**
     * @param $path
     * @return void
     */
    public function processFile($path): void
    {
        // Получаем содержимое файла
        $contents = File::get($path);
        $words = explode("\n", $contents);

        // Создаем директорию, если она не существует
        $storagePath = storage_path('app/library');
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0777, true);
        }

        // Подсчитываем количество букв и сохраняем слова в соответствующие файлы
        $letterCounts = [];
        foreach ($words as $word) {
            $word = trim($word);
            if (empty($word)) continue;

            $firstLetter = mb_substr($word, 0, 1, 'UTF-8');
            $count = mb_substr_count($word, $firstLetter, 'UTF-8');

            // Создаем папку для буквы, если она не существует
            $letterDir = $storagePath . DIRECTORY_SEPARATOR . $firstLetter;
            if (!File::exists($letterDir)) {
                File::makeDirectory($letterDir, 0777, true);
            }

            // Записываем слово в соответствующий файл
            $wordFile = $letterDir . DIRECTORY_SEPARATOR . 'words.txt';
            File::append($wordFile, $word . PHP_EOL);

            // Увеличиваем счетчик буквы
            $letterCounts[$firstLetter] = isset($letterCounts[$firstLetter]) ? $letterCounts[$firstLetter] + $count : $count;
        }

        // Записываем общее количество букв в файл count.txt для каждой буквы
        foreach ($letterCounts as $letter => $count) {
            $countFile = $storagePath . DIRECTORY_SEPARATOR . $letter . DIRECTORY_SEPARATOR . 'count.txt';
            File::put($countFile, $count);
        }
    }
}
