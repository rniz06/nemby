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
        Schema::create('ciudadanos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('nombre_completo')->nullable();
            $table->string('ci')->unique()->nullable();
            $table->string('ruc')->unique()->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('direccion_particular')->nullable();
            $table->enum('tipo_persona', ['Persona Física', 'Persona Jurídica']);
            $table->unsignedBigInteger('barrio_id')->nullable();
            $table->unsignedBigInteger('ciudad_id')->nullable();
            $table->timestamps();

            $table->foreign('barrio_id')->references('id')->on('barrios')->onDelete('set null');
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciudadanos');
    }
};
