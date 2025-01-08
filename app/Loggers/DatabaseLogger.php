<?php

namespace App\Loggers;

use App\Interface\ILogger;
use Illuminate\Support\Facades\DB;


class DatabaseLogger implements ILogger
{

    public function log(string $level, string $message, array $context = []): void
    {
        DB::table('logs')->insert([
            'level' => $level,
            'message' => $message,
            'context' => json_encode($context),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
