<?php

namespace App\Contracts;

interface IAlert
{
    public function success(string $title, string $message): void;

    public function error(string $title, string $message): void;

    public function warning(string $title, string $message): void;

    public function info(string $title, string $message): void;

}
