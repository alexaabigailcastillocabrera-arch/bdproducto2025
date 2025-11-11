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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('pnombre');
            $table->text('pdescripcion')->nullable();
            $table->decimal('preciocompra', 10, 2);
            $table->decimal('preciounitario', 10, 2);
            $table->unsignedInteger('cantidad_ingresada');
            $table->unsignedInteger('stock');

            /* Relaciones */
            $table->foreignId('modelo_id')
                ->constrained('modelos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('marca_id')
                ->constrained('marcas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('unidadmedida_id')
                ->constrained('unidadmedidas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('estado_id')
                ->constrained('estados')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
