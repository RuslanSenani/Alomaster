<?php

namespace App\LogRepo;

use App\Interface\ILogger;

class LogManager
{
    private array $loggers = [];

    public function addLogger(ILogger $logger): void
    {
        $this->loggers[] = $logger;

    }
    public function log(string $level, string $message, array $context = []): void
    {
        foreach ($this->loggers as $logger) {
            $logger->log($level, $message, $context);
        }
    }
}
