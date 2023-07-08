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
        Schema::create('caja_movimientos', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo');
            $table->double('monto',10,2);
            $table->string('motivo');
            $table->integer('estado')->default(1);
            //foraneas
            $table->integer('caja_id');
            //references
            $table->foreign('caja_id')->references('id')->on('cajas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caja_movimientos');
    }
};
