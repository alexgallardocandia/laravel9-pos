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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->double('compra',10,2);
            $table->double('venta',10,2);
            $table->double('cantidad',10,2);
            $table->integer('tipo')->default(1);
            $table->string('motivo');
            //foraneas
            $table->integer('articulo_id');
            //references
            $table->foreign('articulo_id')->references('id')->on('articulos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
