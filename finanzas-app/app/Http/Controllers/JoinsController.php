<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class JoinsController extends Controller
{
    public function index()
    {
        $queries = [];

        // ══════════════════════════════════════════
        // CONSUMIDOR - 3 Joins (Query Builder)
        // ══════════════════════════════════════════

        $queries['join1'] = [
            'title' => 'Consumidores con ingresos (INNER JOIN)',
            'sql'   => "DB::table('consumidores as c')
    ->join('ingresos as i', 'c.id', '=', 'i.consumidorId')
    ->select('c.id', 'c.nombre', 'c.email',
        DB::raw('COUNT(i.id) as total_ingresos'),
        DB::raw('COALESCE(SUM(i.monto), 0) as suma_ingresos'))
    ->groupBy('c.id', 'c.nombre', 'c.email')
    ->orderByDesc('suma_ingresos')
    ->limit(10)
    ->get()",
            'type'  => 'INNER JOIN',
            'data'  => DB::table('consumidores as c')
                ->join('ingresos as i', 'c.id', '=', 'i.consumidorId')
                ->select('c.id', 'c.nombre', 'c.email',
                    DB::raw('COUNT(i.id) as total_ingresos'),
                    DB::raw('COALESCE(SUM(i.monto), 0) as suma_ingresos'))
                ->groupBy('c.id', 'c.nombre', 'c.email')
                ->orderByDesc('suma_ingresos')
                ->limit(10)
                ->get(),
            'cols'  => ['ID', 'Nombre', 'Email', 'Total Ingresos', 'Suma Ingresos'],
            'props' => ['id', 'nombre', 'email', 'total_ingresos', 'suma_ingresos'],
        ];

        $queries['join2'] = [
            'title' => 'Todos los consumidores con sus gastos (LEFT JOIN)',
            'sql'   => "DB::table('consumidores as c')
    ->leftJoin('gastos as g', 'c.id', '=', 'g.consumidorId')
    ->select('c.id', 'c.nombre', 'c.email',
        DB::raw('COUNT(g.id) as total_gastos'),
        DB::raw('COALESCE(SUM(g.monto), 0) as suma_gastos'))
    ->groupBy('c.id', 'c.nombre', 'c.email')
    ->orderByDesc('suma_gastos')
    ->limit(10)
    ->get()",
            'type'  => 'LEFT JOIN',
            'data'  => DB::table('consumidores as c')
                ->leftJoin('gastos as g', 'c.id', '=', 'g.consumidorId')
                ->select('c.id', 'c.nombre', 'c.email',
                    DB::raw('COUNT(g.id) as total_gastos'),
                    DB::raw('COALESCE(SUM(g.monto), 0) as suma_gastos'))
                ->groupBy('c.id', 'c.nombre', 'c.email')
                ->orderByDesc('suma_gastos')
                ->limit(10)
                ->get(),
            'cols'  => ['ID', 'Nombre', 'Email', 'Total Gastos', 'Suma Gastos'],
            'props' => ['id', 'nombre', 'email', 'total_gastos', 'suma_gastos'],
        ];

        $queries['join3'] = [
            'title' => 'Balance financiero por consumidor (LEFT JOIN con subconsultas)',
            'sql'   => "\$ingresosSub = DB::table('ingresos')
    ->select('consumidorId', DB::raw('SUM(monto) as total_ingresos'))
    ->groupBy('consumidorId');

\$gastosSub = DB::table('gastos')
    ->select('consumidorId', DB::raw('SUM(monto) as total_gastos'))
    ->groupBy('consumidorId');

DB::table('consumidores as c')
    ->leftJoinSub(\$ingresosSub, 'ing', fn(\$j) => \$j->on('c.id', '=', 'ing.consumidorId'))
    ->leftJoinSub(\$gastosSub, 'gas', fn(\$j) => \$j->on('c.id', '=', 'gas.consumidorId'))
    ->select('c.id', 'c.nombre', 'c.email',
        DB::raw('COALESCE(ing.total_ingresos, 0) as total_ingresos'),
        DB::raw('COALESCE(gas.total_gastos, 0) as total_gastos'),
        DB::raw('COALESCE(ing.total_ingresos, 0) - COALESCE(gas.total_gastos, 0) as balance'))
    ->orderByDesc('balance')
    ->limit(10)
    ->get()",
            'type'  => 'LEFT JOIN (subconsultas)',
            'data'  => function () {
                $ingresosSub = DB::table('ingresos')
                    ->select('consumidorId', DB::raw('SUM(monto) as total_ingresos'))
                    ->groupBy('consumidorId');

                $gastosSub = DB::table('gastos')
                    ->select('consumidorId', DB::raw('SUM(monto) as total_gastos'))
                    ->groupBy('consumidorId');

                return DB::table('consumidores as c')
                    ->leftJoinSub($ingresosSub, 'ing', function ($join) {
                        $join->on('c.id', '=', 'ing.consumidorId');
                    })
                    ->leftJoinSub($gastosSub, 'gas', function ($join) {
                        $join->on('c.id', '=', 'gas.consumidorId');
                    })
                    ->select('c.id', 'c.nombre', 'c.email',
                        DB::raw('COALESCE(ing.total_ingresos, 0) as total_ingresos'),
                        DB::raw('COALESCE(gas.total_gastos, 0) as total_gastos'),
                        DB::raw('COALESCE(ing.total_ingresos, 0) - COALESCE(gas.total_gastos, 0) as balance'))
                    ->orderByDesc('balance')
                    ->limit(10)
                    ->get();
            },
            'cols'  => ['ID', 'Nombre', 'Email', 'Total Ingresos', 'Total Gastos', 'Balance'],
            'props' => ['id', 'nombre', 'email', 'total_ingresos', 'total_gastos', 'balance'],
        ];

        // ══════════════════════════════════════════
        // INGRESO - 3 Joins (Query Builder)
        // ══════════════════════════════════════════

        $queries['join4'] = [
            'title' => 'Ingresos más altos con consumidor (INNER JOIN)',
            'sql'   => "DB::table('ingresos as i')
    ->join('consumidores as c', 'i.consumidorId', '=', 'c.id')
    ->select('i.id', 'c.nombre as consumidor', 'i.monto', 'i.fecha', 'i.descripcion')
    ->orderByDesc('i.monto')
    ->limit(10)
    ->get()",
            'type'  => 'INNER JOIN',
            'data'  => DB::table('ingresos as i')
                ->join('consumidores as c', 'i.consumidorId', '=', 'c.id')
                ->select('i.id', 'c.nombre as consumidor', 'i.monto', 'i.fecha', 'i.descripcion')
                ->orderByDesc('i.monto')
                ->limit(10)
                ->get(),
            'cols'  => ['ID', 'Consumidor', 'Monto', 'Fecha', 'Descripción'],
            'props' => ['id', 'consumidor', 'monto', 'fecha', 'descripcion'],
        ];

        $queries['join5'] = [
            'title' => 'Todos los consumidores con sus ingresos (RIGHT JOIN)',
            'sql'   => "DB::table('ingresos as i')
    ->rightJoin('consumidores as c', 'i.consumidorId', '=', 'c.id')
    ->select('c.id', 'c.nombre as consumidor',
        'i.id as ingreso_id', 'i.monto', 'i.fecha', 'i.descripcion')
    ->orderBy('c.nombre')
    ->limit(10)
    ->get()",
            'type'  => 'RIGHT JOIN',
            'data'  => DB::table('ingresos as i')
                ->rightJoin('consumidores as c', 'i.consumidorId', '=', 'c.id')
                ->select('c.id', 'c.nombre as consumidor',
                    'i.id as ingreso_id', 'i.monto', 'i.fecha', 'i.descripcion')
                ->orderBy('c.nombre')
                ->limit(10)
                ->get(),
            'cols'  => ['Consumidor ID', 'Consumidor', 'Ingreso ID', 'Monto', 'Fecha', 'Descripción'],
            'props' => ['id', 'consumidor', 'ingreso_id', 'monto', 'fecha', 'descripcion'],
        ];

        $queries['join6'] = [
            'title' => 'Ingresos mensuales por consumidor (JOIN + GROUP BY + DATE_FORMAT)',
            'sql'   => "DB::table('ingresos as i')
    ->join('consumidores as c', 'i.consumidorId', '=', 'c.id')
    ->select('c.nombre as consumidor',
        DB::raw(\"DATE_FORMAT(i.fecha, '%Y-%m') as mes\"),
        DB::raw('COUNT(i.id) as total_ingresos'),
        DB::raw('COALESCE(SUM(i.monto), 0) as suma_mensual'))
    ->groupBy('c.nombre', DB::raw(\"DATE_FORMAT(i.fecha, '%Y-%m')\"))
    ->orderByDesc('mes')
    ->orderByDesc('suma_mensual')
    ->limit(10)
    ->get()",
            'type'  => 'JOIN + GROUP BY + DATE_FORMAT',
            'data'  => DB::table('ingresos as i')
                ->join('consumidores as c', 'i.consumidorId', '=', 'c.id')
                ->select('c.nombre as consumidor',
                    DB::raw("DATE_FORMAT(i.fecha, '%Y-%m') as mes"),
                    DB::raw('COUNT(i.id) as total_ingresos'),
                    DB::raw('COALESCE(SUM(i.monto), 0) as suma_mensual'))
                ->groupBy('c.nombre', DB::raw("DATE_FORMAT(i.fecha, '%Y-%m')"))
                ->orderByDesc('mes')
                ->orderByDesc('suma_mensual')
                ->limit(10)
                ->get(),
            'cols'  => ['Consumidor', 'Mes', 'Total Ingresos', 'Suma Mensual'],
            'props' => ['consumidor', 'mes', 'total_ingresos', 'suma_mensual'],
        ];

        // ══════════════════════════════════════════
        // GASTO - 3 Joins (Query Builder)
        // ══════════════════════════════════════════

        $queries['join7'] = [
            'title' => 'Gastos de Alimentación con consumidor (INNER JOIN + WHERE)',
            'sql'   => "DB::table('gastos as g')
    ->join('consumidores as c', 'g.consumidorId', '=', 'c.id')
    ->select('g.id', 'c.nombre as consumidor', 'g.monto', 'g.fecha', 'g.categoria', 'g.descripcion')
    ->where('g.categoria', 'Alimentación')
    ->orderByDesc('g.monto')
    ->limit(10)
    ->get()",
            'type'  => 'INNER JOIN + WHERE',
            'data'  => DB::table('gastos as g')
                ->join('consumidores as c', 'g.consumidorId', '=', 'c.id')
                ->select('g.id', 'c.nombre as consumidor', 'g.monto', 'g.fecha', 'g.categoria', 'g.descripcion')
                ->where('g.categoria', 'Alimentación')
                ->orderByDesc('g.monto')
                ->limit(10)
                ->get(),
            'cols'  => ['ID', 'Consumidor', 'Monto', 'Fecha', 'Categoría', 'Descripción'],
            'props' => ['id', 'consumidor', 'monto', 'fecha', 'categoria', 'descripcion'],
        ];

        $queries['join8'] = [
            'title' => 'Total gastado por categoría y consumidor (LEFT JOIN + GROUP BY)',
            'sql'   => "DB::table('gastos as g')
    ->leftJoin('consumidores as c', 'g.consumidorId', '=', 'c.id')
    ->select('c.nombre as consumidor', 'g.categoria',
        DB::raw('COUNT(g.id) as cantidad'),
        DB::raw('COALESCE(SUM(g.monto), 0) as total_gastado'))
    ->groupBy('c.nombre', 'g.categoria')
    ->orderByDesc('total_gastado')
    ->limit(10)
    ->get()",
            'type'  => 'LEFT JOIN + GROUP BY',
            'data'  => DB::table('gastos as g')
                ->leftJoin('consumidores as c', 'g.consumidorId', '=', 'c.id')
                ->select('c.nombre as consumidor', 'g.categoria',
                    DB::raw('COUNT(g.id) as cantidad'),
                    DB::raw('COALESCE(SUM(g.monto), 0) as total_gastado'))
                ->groupBy('c.nombre', 'g.categoria')
                ->orderByDesc('total_gastado')
                ->limit(10)
                ->get(),
            'cols'  => ['Consumidor', 'Categoría', 'Cantidad', 'Total Gastado'],
            'props' => ['consumidor', 'categoria', 'cantidad', 'total_gastado'],
        ];

        $queries['join9'] = [
            'title' => 'Consumidores que gastaron más de S/1000 (JOIN + GROUP BY + HAVING)',
            'sql'   => "DB::table('consumidores as c')
    ->join('gastos as g', 'c.id', '=', 'g.consumidorId')
    ->select('c.id', 'c.nombre as consumidor', 'c.email',
        DB::raw('COUNT(g.id) as total_transacciones'),
        DB::raw('COALESCE(SUM(g.monto), 0) as total_gastado'))
    ->groupBy('c.id', 'c.nombre', 'c.email')
    ->having('total_gastado', '>', 1000)
    ->orderByDesc('total_gastado')
    ->limit(10)
    ->get()",
            'type'  => 'JOIN + HAVING',
            'data'  => DB::table('consumidores as c')
                ->join('gastos as g', 'c.id', '=', 'g.consumidorId')
                ->select('c.id', 'c.nombre as consumidor', 'c.email',
                    DB::raw('COUNT(g.id) as total_transacciones'),
                    DB::raw('COALESCE(SUM(g.monto), 0) as total_gastado'))
                ->groupBy('c.id', 'c.nombre', 'c.email')
                ->having('total_gastado', '>', 1000)
                ->orderByDesc('total_gastado')
                ->limit(10)
                ->get(),
            'cols'  => ['ID', 'Consumidor', 'Email', 'Transacciones', 'Total Gastado'],
            'props' => ['id', 'consumidor', 'email', 'total_transacciones', 'total_gastado'],
        ];

        // Ejecutar join3 (closure)
        $queries['join3']['data'] = $queries['join3']['data']();

        return view('joins.index', compact('queries'));
    }
}
