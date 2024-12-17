<?php

use App\Http\admin\vendor\laravel\framework\src\Illuminate\Database\Migrations\Migration;
use App\Http\admin\vendor\laravel\framework\src\Illuminate\Database\Schema\Blueprint;
use App\Http\admin\vendor\laravel\framework\src\Illuminate\Support\Facades\Schema;
use App\Http\admin\app\Traits\MigrationHelper;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    use MigrationHelper;

    public function up(): void
    {
        if (!Schema::hasTable('db_models')) {
            Schema::create('db_models', function (Blueprint $table) {
                $table->id();
                $table->string('name', 60)->unique();
                $this->addCommonColumns($table);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('db_models');
    }
};
