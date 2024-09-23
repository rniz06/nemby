<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departamentos = [
            'ADULTOS MAYORES',
            'ASESORIA JURIDICA',
            'ARTES',
            'AUDITORIA INTERNA',
            'CATASTRO',
            'COMUNICACIONES',
            'COMISIONES VECINALES',
            'CULTURA',
            'DESARROLLO HUMANO',
            'DESARROLLO SOCIAL',
            'DISCAPACIDAD',
            'EDUCACION',
            'GABINETE',
            'GRAL. ADMINISTRACIÓN Y FINANZAS',
            'JUVENTUD',
            'JUZGADO DE FALTAS',
            'MECIP',
            'MEDIO AMBIENTE',
            'MEDIACION',
            'MIPYMES',
            'OBRAS',
            'PREVENCION DE ADICCIONES',
            'PROTOCOLO Y CEREMONIAL',
            'SALUD',
            'SECRETARIA DE LA JUNTA',
            'SECRETARIA DE LA MUJER',
            'SECRETARIA GENERAL',
            'SECRETARIA PRIVADA',
            'SEGURIDAD CIUDADANA',
            'SEGURIDAD Y TRANSITO',
            'SERVICIOS GENERALES',
            'SEDECO',
            'TERRITORIO SOCIAL',
            'TIC',
            'TURISMO',
            'UAIP',
            'UOC',
        ];

        // Iterar sobre el array de ciudades y insertar cada una en la base de datos
        foreach ($departamentos as $departamento) {
            DB::table('departamentos')->insert([
                'departamento' => $departamento,
            ]);
        }
    }
}
