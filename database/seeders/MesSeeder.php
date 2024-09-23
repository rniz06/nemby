<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meses = [
            ['mes' => 'Enero', 'numero' => 1],
            ['mes' => 'Febrero', 'numero' => 2],
            ['mes' => 'Marzo', 'numero' => 3],
            ['mes' => 'Abril', 'numero' => 4],
            ['mes' => 'Mayo', 'numero' => 5],
            ['mes' => 'Junio', 'numero' => 6],
            ['mes' => 'Julio', 'numero' => 7],
            ['mes' => 'Agosto', 'numero' => 8],
            ['mes' => 'Septiembre', 'numero' => 9],
            ['mes' => 'Octubre', 'numero' => 10],
            ['mes' => 'Noviembre', 'numero' => 11],
            ['mes' => 'Diciembre', 'numero' => 12],
        ];

        DB::table('meses')->insert($meses);
    }
}
