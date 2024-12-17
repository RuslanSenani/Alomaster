<?php

use App\Traits\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    /**
     * Run the migrations.
     */

    use MigrationHelper;

    public function up(): void
    {
        if (!Schema::hasTable('stock_ins')) {
            Schema::create('stock_ins', function (Blueprint $table) {
                $table->id();
                $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
                $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
                $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
                $table->foreignId('model_id')->constrained('db_models')->onDelete('cascade');
                $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
                $table->string("product_img", 255)->nullable();
                $table->string("product_desc", 255)->nullable();
                $table->string("product_code", 100);
                $table->integer("product_enter_count");
                $table->string("product_unit", 20);
                $table->decimal("product_unit_price", 10, 2);
                $table->date('enter_date');
                $this->addCommonColumns($table);

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_ins');
    }
};
