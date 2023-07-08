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
        Schema::create('caja_compras', function (Blueprint $table) {
            $table->id();
            $table->double('monto',10,2);
            $table->integer('estado')->default(1);
            //foraneas
            $table->integer('caja_id');
            $table->integer('compra_id');
            //referencias
            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->foreign('compra_id')->references('id')->on('compras');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caja_compras');
    }
};
