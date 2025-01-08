<?php

namespace App\Interface;

interface ILogger
{
    public function log(string $level, string $message, array $context = []): void;

}
