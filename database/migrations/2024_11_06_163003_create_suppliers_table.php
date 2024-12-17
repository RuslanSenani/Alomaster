<?php

use App\Http\admin\app\Traits\MigrationHelper;
use App\Http\admin\vendor\laravel\framework\src\Illuminate\Database\Migrations\Migration;
use App\Http\admin\vendor\laravel\framework\src\Illuminate\Database\Schema\Blueprint;
use App\Http\admin\vendor\laravel\framework\src\Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    use MigrationHelper;
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('email')->unique();
            $table->string('phone');
            $this->addCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
