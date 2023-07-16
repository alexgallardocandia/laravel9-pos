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
        Schema::create('moneda_images', function (Blueprint $table) {
            $table->id();
            $table->integer('estado')->default(1);
            //foraneas            
            $table->foreignId('moneda_id')->nullable()->constrained('monedas');
            $table->foreignId('image_id')->nullable()->constrained('images');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moneda_images');
    }
};
