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
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('asunto')->nullable();
            $table->string('n_mesa_entrada')->nullable();
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->unsignedBigInteger('agregado_por')->nullable();
            $table->unsignedBigInteger('ciudadano_id')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('expediente_estados')->onDelete('set null');
            $table->foreign('agregado_por')->references('id')->on('users')->onDelete('set null');
            $table->foreign('ciudadano_id')->references('id')->on('ciudadanos')->onDelete('set null');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};
