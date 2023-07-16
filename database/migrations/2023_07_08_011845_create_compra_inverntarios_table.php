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
        Schema::create('compra_inverntarios', function (Blueprint $table) {
            $table->id();
            $table->double('precio',10,2);
            $table->double('cantidad',10,2);
            $table->integer('estado')->default(1);
            //foraneas
            $table->foreignId('inventario_id')->nullable()->constrained('inventarios');
            $table->foreignId('compra_id')->nullable()->constrained('compras');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_inverntarios');
    }
};
