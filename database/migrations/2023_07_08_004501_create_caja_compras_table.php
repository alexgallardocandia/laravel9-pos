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
            $table->foreignId('caja_id')->nullable()->constrained('cajas');
            $table->foreignId('compra_id')->nullable()->constrained('compras');            
            

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
