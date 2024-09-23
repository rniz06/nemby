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
        Schema::create('expediente_archivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_original')->nullable();
            $table->string('nombre_a_mostrar')->nullable();
            $table->string('ruta')->nullable();
            $table->string('tamano')->nullable();
            $table->string('tipo')->nullable();
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('expediente_id')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('expediente_id')->references('id')->on('expedientes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expediente_archivos');
    }
};
