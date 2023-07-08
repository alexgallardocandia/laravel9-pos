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
            $table->integer('medida_id');
            $table->integer('marca_id');
            $table->integer('categoria_id');

            //referencias
            $table->foreign('medida_id')->references('id')->on('medidas');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('categoria_id')->references('id')->on('categorias');

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
