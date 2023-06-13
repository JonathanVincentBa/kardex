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
        Schema::create('detalle_hoja_rutas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_hoja_ruta')->constrained('hoja_rutas');
            $table->integer('remitente');
            $table->text('descripcion',500);
            $table->string('destinatario');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_hoja_rutas');
    }
};
