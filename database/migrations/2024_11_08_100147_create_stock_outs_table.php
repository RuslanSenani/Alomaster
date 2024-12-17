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

        if (!Schema::hasTable('stock_outs')) {
            Schema::create('stock_outs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('stock_in_id')->constrained('stock_ins')->onDelete('cascade');
                $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
                $table->foreignId('customer_id')->constrained()->onDelete('cascade');
                $table->string("model_name", 100);
                $table->string("category_name", 100);
                $table->string("product_name", 100);
                $table->string("product_description", 255)->nullable();
                $table->string("product_code", 100);
                $table->integer("product_exit_count");
                $table->string("product_unit", 20);
                $table->double("product_unit_sale_price");
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
