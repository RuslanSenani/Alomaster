<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use RealRashid\SweetAlert\Facades\Alert;

class AlertServices implements IAlert
{

    public function success(string $title, string $message,int $autoClose=3000): void
    {
        Alert::success($title, $message)
            ->position('top-right')
            ->toToast()
            ->autoclose($autoClose);
    }

    public function error(string $title, string $message,int $autoClose=3000): void
    {
        Alert::error($title, $message)
            ->position('top-right')
            ->toToast()
            ->autoclose($autoClose);
    }

    public function warning(string $title, string $message,int $autoClose=3000): void
    {
        Alert::warning($title, $message)
            ->position('top-right')
            ->toToast()
            ->autoclose($autoClose);
    }

    public function info(string $title, string $message,int $autoClose=3000): void
    {
        Alert::info($title, $message)
            ->position('top-right')
            ->toToast()
            ->autoclose($autoClose);
    }
}
