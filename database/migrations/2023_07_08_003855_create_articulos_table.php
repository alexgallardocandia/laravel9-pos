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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('barra');
            $table->double('compra',10,2);
            $table->double('venta',10,2);
            $table->double('stock_minimo',10,2);
            $table->integer('estado')->default(1);            
            
            //foraneas
            $table->foreignId('medida_id')->nullable()->constrained('medidas');
            $table->foreignId('marca_id')->nullable()->constrained('marcas');
            $table->foreignId('categoria_id')->nullable()->constrained('categorias');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
