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

        if (!Schema::hasTable('stock_outs')) {
            Schema::create('stock_outs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
                $table->foreignId('customer_id')->constrained()->onDelete('cascade');
                $table->foreignId('stock_in_id')->constrained('stock_ins')->onDelete('cascade');
                $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
                $table->string("product_name", 100);
                $table->string("product_description", 255)->nullable();
                $table->string("product_code", 100);
                $table->string("product_category", 100);
                $table->integer("product_exit_count");
                $table->string("product_unit", 20);
                $table->double("product-unit_sale_price");
                $table->date('exit_date');
                $this->addCommonColumns($table);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_outs');
    }
};
