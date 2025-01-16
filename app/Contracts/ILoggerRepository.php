<?php

namespace App\Contracts;

interface ILoggerRepository
{
    public function log(string $level, string $message, array $context = []): void;

}
