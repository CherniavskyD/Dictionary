<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;

class WordRepository
{
    public function saveWords(array $words)
    {
        // Пример сохранения данных
        try {
        } catch (\Exception $e) {
            Log::error("Database connection error: " . $e->getMessage());
            File::append(__DIR__ . '/../../mysql.log', $e->getMessage() . PHP_EOL);
        }
    }
}
