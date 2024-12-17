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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
                $table->string("product_name");
                $table->string("product_code");
                $table->unique(['product_name', 'product_code']);
                $table->text("product_description")->nullable();
                $table->string('product_img')->default('');
                $this->addCommonColumns($table);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
