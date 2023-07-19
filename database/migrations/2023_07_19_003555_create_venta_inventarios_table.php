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
        Schema::create('venta_inventarios', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio',10,2);
            $table->decimal('cantidad',10,2);
            $table->integer('estado')->default(1);
            //foraneas            
            $table->foreignId('inventario_id')->nullable()->constrained('inventarios');
            $table->foreignId('venta_id')->nullable()->constrained('ventas');  
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_inventarios');
    }
};
