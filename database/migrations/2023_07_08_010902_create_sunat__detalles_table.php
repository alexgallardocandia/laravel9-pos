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
        Schema::create('sunat_detalles', function (Blueprint $table) {
            $table->id();
            $table->string('unidad_de_medida');
            $table->string('codigo');
            $table->string('description');
            $table->string('cantidad');
            $table->string('valor_unitario');
            $table->string('precio_unitario');
            $table->string('descuento');
            $table->string('subtotal');
            $table->string('tipo_de_igv');
            $table->string('igv');
            $table->string('total');
            $table->string('anticipo_regularizacion');
            $table->string('anticipo_documento_serie');
            $table->string('anticipo_documento_numero');
            //foreaneas
            $table->integer('sunat_id');
            //references
            $table->foreign('sunat_id')->references('id')->on('sunats');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunat_detalles');
    }
    
};
