<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpedienteEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            'RECIEN INGRESADO',
            'EN PROGRESO',
            'FINALIZADO',
        ];

        // Iterar sobre el array de estados y insertar cada una en la base de datos
        foreach ($estados as $estado) {
            DB::table('expediente_estados')->insert([
                'estado' => $estado,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
