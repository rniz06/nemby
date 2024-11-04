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
        Schema::create('expediente_movimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expediente_id')->nullable();
            $table->unsignedBigInteger('departamento_origen_id')->nullable();
            $table->unsignedBigInteger('departamento_destino_id')->nullable();
            $table->enum('estado', ['PENDIENTE', 'ACEPTADO', 'RECHAZADO'])->nullable();
            $table->text('comentario_envio')->nullable();
            $table->text('comentario_rechazo')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->timestamps();
            //
            $table->foreign('expediente_id')->references('id')->on('expedientes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('departamento_origen_id')->references('id')->on('departamentos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('departamento_destino_id')->references('id')->on('departamentos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expediente_movimientos');
    }
};
