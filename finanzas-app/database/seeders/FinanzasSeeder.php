<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinanzasSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Poblando consumidores...');
        $this->seedConsumidores();

        $this->command->info('Poblando ingresos...');
        $this->seedIngresos();

        $this->command->info('Poblando gastos...');
        $this->seedGastos();

        $this->command->info('¡Poblado completado!');
    }

    private function seedConsumidores(): void
    {
        $batch = [];
        for ($i = 1; $i <= 1000; $i++) {
            $batch[] = [
                'nombre'     => "Consumidor {$i}",
                'email'      => "consumidor{$i}@example.com",
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($batch) >= 100) {
                DB::table('consumidores')->insert($batch);
                $batch = [];
            }
        }
        if ($batch) {
            DB::table('consumidores')->insert($batch);
        }
    }

    private function seedIngresos(): void
    {
        $maxId = DB::table('consumidores')->max('id');
        $batch = [];

        for ($i = 1; $i <= 1000; $i++) {
            $batch[] = [
                'consumidorId' => rand(1, $maxId),
                'monto'        => round(100 + mt_rand() / mt_getrandmax() * 5000, 2),
                'fecha'        => now()->subDays(rand(0, 730))->format('Y-m-d'),
                'descripcion'  => "Ingreso aleatorio #{$i}",
                'created_at'   => now(),
                'updated_at'   => now(),
            ];

            if (count($batch) >= 100) {
                DB::table('ingresos')->insert($batch);
                $batch = [];
            }
        }
        if ($batch) {
            DB::table('ingresos')->insert($batch);
        }
    }

    private function seedGastos(): void
    {
        $maxId = DB::table('consumidores')->max('id');
        $categorias = ['Alimentación', 'Transporte', 'Vivienda', 'Entretenimiento', 'Salud', 'Educación', 'Servicios', 'Otros'];
        $batch = [];

        for ($i = 1; $i <= 1000; $i++) {
            $batch[] = [
                'consumidorId' => rand(1, $maxId),
                'monto'        => round(20 + mt_rand() / mt_getrandmax() * 1500, 2),
                'fecha'        => now()->subDays(rand(0, 730))->format('Y-m-d'),
                'categoria'    => $categorias[array_rand($categorias)],
                'descripcion'  => "Gasto aleatorio #{$i}",
                'created_at'   => now(),
                'updated_at'   => now(),
            ];

            if (count($batch) >= 100) {
                DB::table('gastos')->insert($batch);
                $batch = [];
            }
        }
        if ($batch) {
            DB::table('gastos')->insert($batch);
        }
    }
}
