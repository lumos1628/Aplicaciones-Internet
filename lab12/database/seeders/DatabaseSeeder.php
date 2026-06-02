<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Consumidor;
use App\Models\Ingreso;
use App\Models\Gasto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario de prueba
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Crear consumidores
        $c1 = Consumidor::create(['nombre' => 'Alice Smith',  'email' => 'alice@example.com']);
        $c2 = Consumidor::create(['nombre' => 'Bob Johnson',  'email' => 'bob@example.com']);
        $c3 = Consumidor::create(['nombre' => 'Carlos Pérez', 'email' => 'carlos@example.com']);

        // Ingresos de Alice
        $c1->ingresos()->createMany([
            ['monto' => 3500.00, 'fecha' => '2026-05-01', 'descripcion' => 'Salario mayo'],
            ['monto' =>  500.00, 'fecha' => '2026-05-15', 'descripcion' => 'Freelance diseño'],
        ]);

        // Ingresos de Bob
        $c2->ingresos()->createMany([
            ['monto' => 4200.00, 'fecha' => '2026-05-01', 'descripcion' => 'Salario mayo'],
            ['monto' =>  800.00, 'fecha' => '2026-05-20', 'descripcion' => 'Venta de equipo'],
        ]);

        // Ingresos de Carlos
        $c3->ingresos()->createMany([
            ['monto' => 2800.00, 'fecha' => '2026-05-01', 'descripcion' => 'Salario mayo'],
        ]);

        // Gastos de Alice
        $c1->gastos()->createMany([
            ['monto' =>  650.00, 'fecha' => '2026-05-03', 'categoria' => 'Alimentación',    'descripcion' => 'Compras supermercado'],
            ['monto' =>  120.00, 'fecha' => '2026-05-10', 'categoria' => 'Transporte',      'descripcion' => 'Gasolina'],
            ['monto' =>  200.00, 'fecha' => '2026-05-18', 'categoria' => 'Entretenimiento', 'descripcion' => 'Cine y restaurante'],
        ]);

        // Gastos de Bob
        $c2->gastos()->createMany([
            ['monto' =>  900.00, 'fecha' => '2026-05-05', 'categoria' => 'Salud',      'descripcion' => 'Consulta médica'],
            ['monto' =>  350.00, 'fecha' => '2026-05-12', 'categoria' => 'Educación',  'descripcion' => 'Curso online'],
        ]);

        // Gastos de Carlos
        $c3->gastos()->createMany([
            ['monto' =>  450.00, 'fecha' => '2026-05-07', 'categoria' => 'Alimentación', 'descripcion' => 'Mercado semanal'],
            ['monto' =>  180.00, 'fecha' => '2026-05-14', 'categoria' => 'Transporte',   'descripcion' => 'Bus mensual'],
            ['monto' =>  100.00, 'fecha' => '2026-05-22', 'categoria' => 'Otros',        'descripcion' => 'Misceláneos'],
        ]);
    }
}