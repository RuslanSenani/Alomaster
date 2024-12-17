<?php

namespace App\Traits;


use Illuminate\Database\Schema\Blueprint;

trait MigrationHelper
{
    public function addCommonColumns(Blueprint $table): void
    {
        $table->softDeletes('deleted_at',0);
        $table->timestamps();
    }

}
