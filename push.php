<?php

require __DIR__ . '/vendor/autoload.php';

use App\Repositories\WordRepository;
use Illuminate\Support\Facades\File;

try {
    $wordRepository = new WordRepository();
    // Допустим, у нас есть данные для вставки
    $words = ['example1', 'example2'];
    $wordRepository->saveWords($words);
    echo "Data inserted successfully.\n";
} catch (Exception $e) {
    File::append(__DIR__ . '/mysql.log', $e->getMessage() . PHP_EOL);
    echo "Failed to connect to the database.\n";
}
