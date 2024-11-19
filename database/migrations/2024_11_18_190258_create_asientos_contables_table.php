<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asientos_contables', function (Blueprint $table) {
            $table->id();
    $table->foreignId('compra_id')->nullable()->constrained('compras')->onDelete('set null');
    $table->foreignId('venta_id')->nullable()->constrained('ventas')->onDelete('set null');
    $table->string('descripcion');
    $table->string('BI', 10, 2)->nullable();;
    $table->string('IGV', 10, 2)->nullable();;
    $table->string('total', 10, 2)->nullable();;
    $table->decimal('debito', 10, 2);
    $table->decimal('credito', 10, 2);
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asientos_contables');
    }
};
