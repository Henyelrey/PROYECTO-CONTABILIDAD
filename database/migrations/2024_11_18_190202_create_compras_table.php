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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 255);
            $table->date('fecha');
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('proveedor_id'); // Agregar columna proveedor_id
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade'); // Definir la clave foránea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
