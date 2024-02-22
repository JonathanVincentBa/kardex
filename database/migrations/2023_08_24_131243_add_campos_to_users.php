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
        Schema::table('users', function (Blueprint $table) {
            $table->string('dni')->after('password');
            $table->string('profesion')->after('dni')->nullable();
            $table->time('fecha_nac')->after('profesion')->nullable();
            $table->string('estado_civil')->after('fecha_nac')->nullable();
            $table->string('num_hijos')->after('estado_civil')->nullable();
            $table->string('direccion')->after('num_hijos')->nullable();
            $table->string('fono')->after('direccion')->nullable();
            $table->string('celular')->after('fono')->nullable();
            $table->string('email_personal')->after('celular')->nullable();
            $table->softDeletes()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
