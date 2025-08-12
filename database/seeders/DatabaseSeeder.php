<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Demo',
            'email' => 'demo@demo.com',
            'password' => Hash::make('demo'), 
        ]);

        Sucursal::create([
            'nombre' => 'Central',
            'direccion' => 'Asuncion, Paraguay',
            'telefono' => '984',
            'documento' => ' ',
            'impresora' => 'local',
            'impresora_url' => 'http://localhost/'
        ]);
    }
}
