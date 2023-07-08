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
            $table->integer('moneda_id');
            $table->integer('image_id');
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->foreign('image_id')->references('id')->on('images');

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
