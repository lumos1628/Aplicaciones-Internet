<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class JoinsController extends Controller
{
    public function index()
    {
        $queries = [];

        // ══════════════════════════════════════════
        // CONSUMIDOR - 3 Joins
        // ══════════════════════════════════════════

        $queries['join1'] = [
            'title' => 'Consumidores con ingresos (INNER JOIN)',
            'sql'   => 'SELECT c.id, c.nombre, c.email,
       COUNT(i.id) AS total_ingresos,
       COALESCE(SUM(i.monto), 0) AS suma_ingresos
FROM consumidores c
INNER JOIN ingresos i ON c.id = i.consumidorId
GROUP BY c.id, c.nombre, c.email
ORDER BY suma_ingresos DESC
LIMIT 10',
            'type'  => 'INNER JOIN',
            'data'  => DB::select("
                SELECT c.id, c.nombre, c.email,
                       COUNT(i.id) AS total_ingresos,
                       COALESCE(SUM(i.monto), 0) AS suma_ingresos
                FROM consumidores c
                INNER JOIN ingresos i ON c.id = i.consumidorId
                GROUP BY c.id, c.nombre, c.email
                ORDER BY suma_ingresos DESC
                LIMIT 10
            "),
            'cols'  => ['ID', 'Nombre', 'Email', 'Total Ingresos', 'Suma Ingresos'],
        ];

        $queries['join2'] = [
            'title' => 'Todos los consumidores con sus gastos (LEFT JOIN)',
            'sql'   => 'SELECT c.id, c.nombre, c.email,
       COUNT(g.id) AS total_gastos,
       COALESCE(SUM(g.monto), 0) AS suma_gastos
FROM consumidores c
LEFT JOIN gastos g ON c.id = g.consumidorId
GROUP BY c.id, c.nombre, c.email
ORDER BY suma_gastos DESC
LIMIT 10',
            'type'  => 'LEFT JOIN',
            'data'  => DB::select("
                SELECT c.id, c.nombre, c.email,
                       COUNT(g.id) AS total_gastos,
                       COALESCE(SUM(g.monto), 0) AS suma_gastos
                FROM consumidores c
                LEFT JOIN gastos g ON c.id = g.consumidorId
                GROUP BY c.id, c.nombre, c.email
                ORDER BY suma_gastos DESC
                LIMIT 10
            "),
            'cols'  => ['ID', 'Nombre', 'Email', 'Total Gastos', 'Suma Gastos'],
        ];

        $queries['join3'] = [
            'title' => 'Balance financiero por consumidor (LEFT JOIN con subconsultas)',
            'sql'   => 'SELECT c.id, c.nombre, c.email,
       COALESCE(ing.total_ingresos, 0) AS total_ingresos,
       COALESCE(gas.total_gastos, 0) AS total_gastos,
       COALESCE(ing.total_ingresos, 0) - COALESCE(gas.total_gastos, 0) AS balance
FROM consumidores c
LEFT JOIN (
    SELECT consumidorId, SUM(monto) AS total_ingresos
    FROM ingresos GROUP BY consumidorId
) ing ON c.id = ing.consumidorId
LEFT JOIN (
    SELECT consumidorId, SUM(monto) AS total_gastos
    FROM gastos GROUP BY consumidorId
) gas ON c.id = gas.consumidorId
ORDER BY balance DESC
LIMIT 10',
            'type'  => 'LEFT JOIN (subconsultas)',
            'data'  => DB::select("
                SELECT c.id, c.nombre, c.email,
                       COALESCE(ing.total_ingresos, 0) AS total_ingresos,
                       COALESCE(gas.total_gastos, 0) AS total_gastos,
                       COALESCE(ing.total_ingresos, 0) - COALESCE(gas.total_gastos, 0) AS balance
                FROM consumidores c
                LEFT JOIN (
                    SELECT consumidorId, SUM(monto) AS total_ingresos
                    FROM ingresos GROUP BY consumidorId
                ) ing ON c.id = ing.consumidorId
                LEFT JOIN (
                    SELECT consumidorId, SUM(monto) AS total_gastos
                    FROM gastos GROUP BY consumidorId
                ) gas ON c.id = gas.consumidorId
                ORDER BY balance DESC
                LIMIT 10
            "),
            'cols'  => ['ID', 'Nombre', 'Email', 'Total Ingresos', 'Total Gastos', 'Balance'],
        ];

        // ══════════════════════════════════════════
        // INGRESO - 3 Joins
        // ══════════════════════════════════════════

        $queries['join4'] = [
            'title' => 'Ingresos más altos con consumidor (INNER JOIN)',
            'sql'   => 'SELECT i.id, c.nombre AS consumidor, i.monto, i.fecha, i.descripcion
FROM ingresos i
INNER JOIN consumidores c ON i.consumidorId = c.id
ORDER BY i.monto DESC
LIMIT 10',
            'type'  => 'INNER JOIN',
            'data'  => DB::select("
                SELECT i.id, c.nombre AS consumidor, i.monto, i.fecha, i.descripcion
                FROM ingresos i
                INNER JOIN consumidores c ON i.consumidorId = c.id
                ORDER BY i.monto DESC
                LIMIT 10
            "),
            'cols'  => ['ID', 'Consumidor', 'Monto', 'Fecha', 'Descripción'],
        ];

        $queries['join5'] = [
            'title' => 'Todos los consumidores con sus ingresos (RIGHT JOIN)',
            'sql'   => 'SELECT c.id, c.nombre AS consumidor,
       i.id AS ingreso_id, i.monto, i.fecha, i.descripcion
FROM ingresos i
RIGHT JOIN consumidores c ON i.consumidorId = c.id
ORDER BY c.nombre
LIMIT 10',
            'type'  => 'RIGHT JOIN',
            'data'  => DB::select("
                SELECT c.id, c.nombre AS consumidor,
                       i.id AS ingreso_id, i.monto, i.fecha, i.descripcion
                FROM ingresos i
                RIGHT JOIN consumidores c ON i.consumidorId = c.id
                ORDER BY c.nombre
                LIMIT 10
            "),
            'cols'  => ['Consumidor ID', 'Consumidor', 'Ingreso ID', 'Monto', 'Fecha', 'Descripción'],
        ];

        $queries['join6'] = [
            'title' => 'Ingresos mensuales por consumidor (JOIN + GROUP BY + DATE_FORMAT)',
            'sql'   => 'SELECT c.nombre AS consumidor,
       DATE_FORMAT(i.fecha, \'%Y-%m\') AS mes,
       COUNT(i.id) AS total_ingresos,
       COALESCE(SUM(i.monto), 0) AS suma_mensual
FROM ingresos i
JOIN consumidores c ON i.consumidorId = c.id
GROUP BY c.nombre, DATE_FORMAT(i.fecha, \'%Y-%m\')
ORDER BY mes DESC, suma_mensual DESC
LIMIT 10',
            'type'  => 'JOIN + GROUP BY + DATE_FORMAT',
            'data'  => DB::select("
                SELECT c.nombre AS consumidor,
                       DATE_FORMAT(i.fecha, '%Y-%m') AS mes,
                       COUNT(i.id) AS total_ingresos,
                       COALESCE(SUM(i.monto), 0) AS suma_mensual
                FROM ingresos i
                JOIN consumidores c ON i.consumidorId = c.id
                GROUP BY c.nombre, DATE_FORMAT(i.fecha, '%Y-%m')
                ORDER BY mes DESC, suma_mensual DESC
                LIMIT 10
            "),
            'cols'  => ['Consumidor', 'Mes', 'Total Ingresos', 'Suma Mensual'],
        ];

        // ══════════════════════════════════════════
        // GASTO - 3 Joins
        // ══════════════════════════════════════════

        $queries['join7'] = [
            'title' => 'Gastos de Alimentación con consumidor (INNER JOIN + WHERE)',
            'sql'   => 'SELECT g.id, c.nombre AS consumidor, g.monto, g.fecha, g.categoria, g.descripcion
FROM gastos g
INNER JOIN consumidores c ON g.consumidorId = c.id
WHERE g.categoria = \'Alimentación\'
ORDER BY g.monto DESC
LIMIT 10',
            'type'  => 'INNER JOIN + WHERE',
            'data'  => DB::select("
                SELECT g.id, c.nombre AS consumidor, g.monto, g.fecha, g.categoria, g.descripcion
                FROM gastos g
                INNER JOIN consumidores c ON g.consumidorId = c.id
                WHERE g.categoria = 'Alimentación'
                ORDER BY g.monto DESC
                LIMIT 10
            "),
            'cols'  => ['ID', 'Consumidor', 'Monto', 'Fecha', 'Categoría', 'Descripción'],
        ];

        $queries['join8'] = [
            'title' => 'Total gastado por categoría y consumidor (LEFT JOIN + GROUP BY)',
            'sql'   => 'SELECT c.nombre AS consumidor, g.categoria,
       COUNT(g.id) AS cantidad,
       COALESCE(SUM(g.monto), 0) AS total_gastado
FROM gastos g
LEFT JOIN consumidores c ON g.consumidorId = c.id
GROUP BY c.nombre, g.categoria
ORDER BY total_gastado DESC
LIMIT 10',
            'type'  => 'LEFT JOIN + GROUP BY',
            'data'  => DB::select("
                SELECT c.nombre AS consumidor, g.categoria,
                       COUNT(g.id) AS cantidad,
                       COALESCE(SUM(g.monto), 0) AS total_gastado
                FROM gastos g
                LEFT JOIN consumidores c ON g.consumidorId = c.id
                GROUP BY c.nombre, g.categoria
                ORDER BY total_gastado DESC
                LIMIT 10
            "),
            'cols'  => ['Consumidor', 'Categoría', 'Cantidad', 'Total Gastado'],
        ];

        $queries['join9'] = [
            'title' => 'Consumidores que gastaron más de S/1000 (JOIN + GROUP BY + HAVING)',
            'sql'   => 'SELECT c.id, c.nombre AS consumidor, c.email,
       COUNT(g.id) AS total_transacciones,
       COALESCE(SUM(g.monto), 0) AS total_gastado
FROM consumidores c
JOIN gastos g ON c.id = g.consumidorId
GROUP BY c.id, c.nombre, c.email
HAVING total_gastado > 1000
ORDER BY total_gastado DESC
LIMIT 10',
            'type'  => 'JOIN + HAVING',
            'data'  => DB::select("
                SELECT c.id, c.nombre AS consumidor, c.email,
                       COUNT(g.id) AS total_transacciones,
                       COALESCE(SUM(g.monto), 0) AS total_gastado
                FROM consumidores c
                JOIN gastos g ON c.id = g.consumidorId
                GROUP BY c.id, c.nombre, c.email
                HAVING total_gastado > 1000
                ORDER BY total_gastado DESC
                LIMIT 10
            "),
            'cols'  => ['ID', 'Consumidor', 'Email', 'Transacciones', 'Total Gastado'],
        ];

        return view('joins.index', compact('queries'));
    }
}
