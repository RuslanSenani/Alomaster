<?php

namespace App\Contracts;

interface IAlert
{
    public function success(string $title, string $message,int $autoClose): void;

    public function error(string $title, string $message,int $autoClose): void;

    public function warning(string $title, string $message,int $autoClose): void;

    public function info(string $title, string $message,int $autoClose): void;

}
