<?php

namespace App\Repositories;

use App\Contracts\ILoggerRepository;
use Illuminate\Support\Facades\DB;


class DatabaseLoggerRepository implements ILoggerRepository
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
