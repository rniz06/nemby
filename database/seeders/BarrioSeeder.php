<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarrioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // LISTADO DE BARRIOS DE LA CIUDAD DE ÑEMBY
        $barrios = [
            'VILLA ANITA',
            "PA'I NU",
            'MBOKAJATY',
            'VISTA ALEGRE',
            'CENTRO',
            'SALINAS',
            'RINCON',
            'CAAGUAZU',
            'CANADITA',
            'LOS NARANJOS',
            '3 DE MAYO',
            'SAN MIGUEL',
        ];

        // Obtener el ID de la ciudad NEMBY
        $ciudadId = DB::table('ciudades')->where('ciudad', 'ÑEMBY')->value('id');

        // Iterar sobre el array de distritos y insertar cada uno en la base de datos
        foreach ($barrios as $barrio) {
            DB::table('barrios')->insert([
                'barrio' => $barrio,
                'ciudad_id' => $ciudadId,
            ]);
        }
    }
}
