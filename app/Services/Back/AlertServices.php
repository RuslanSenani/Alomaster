<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use RealRashid\SweetAlert\Facades\Alert;

class AlertServices implements IAlert
{

    public function success(string $title, string $message): void
    {
        Alert::success($title, $message)
            ->position('top-right')
            ->toToast()
            ->autoclose(3000);
    }

    public function error(string $title, string $message): void
    {
        Alert::error($title, $message)
            ->position('top-right')
            ->toToast()
            ->autoclose(3000);
    }

    public function warning(string $title, string $message): void
    {
        Alert::warning($title, $message)
            ->position('top-right')
            ->toToast()
            ->autoclose(3000);
    }

    public function info(string $title, string $message): void
    {
        Alert::info($title, $message)
            ->position('top-right')
            ->toToast()
            ->autoclose(3000);
    }
}
