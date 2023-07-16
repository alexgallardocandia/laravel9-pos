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
        Schema::create('sunats', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_de_comprobante');
            $table->string('serie');
            $table->string('numero');
            $table->string('enlace');
            $table->string('aceptada_por_sunat');
            $table->string('sunat_description');
            $table->string('sunat_note');
            $table->string('sunat_responsecode');
            $table->string('sunat_soap_error');
            $table->string('anulado');
            $table->string('pdf_zip_base64');
            $table->string('xml_zip_base64');
            $table->string('cdr_zip_base64');
            $table->string('cadena_para_codigo_qr');
            $table->string('codigo_hash');
            $table->string('enlace_del_pdf');
            $table->string('enlace_del_xml');
            $table->string('enlace_del_cdr');
            $table->string('cliente_numero_de_documento');
            $table->string('operacion');
            $table->string('sunat_transaction');
            $table->string('cliente_tipo_de_documento');
            $table->string('cliente_direccion');
            $table->integer('estado')->default(1);
            $table->double('total',10,2);
            $table->double('total_gravada',10,2);
            $table->double('total_igv',10,2);            
            //foraneas            
            $table->foreignId('serie_id')->nullable()->constrained('series');
            $table->foreignId('venta_id')->nullable()->constrained('ventas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunats');
    }
};
