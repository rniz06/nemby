<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Ronald Niz',
            'email' => 'desarrollo@marka.com.py',
            'password' => Hash::make('Rann2006')
        ]);

        $this->call([
            CiudadSeeder::class,
            BarrioSeeder::class,
            DepartamentoSeeder::class,
            MesSeeder::class,
        ]);
    }
}
