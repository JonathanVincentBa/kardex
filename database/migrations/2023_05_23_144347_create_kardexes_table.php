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
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_control_archivo')->constrained('control_archivos');
            $table->integer('cliente_id');
            $table->integer('servicio');
            $table->integer('tipo_servicio');
            $table->string('destinatario');
            $table->text('descripcion',500);
            $table->integer('enviadoPor');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kardexes');
    }
};
