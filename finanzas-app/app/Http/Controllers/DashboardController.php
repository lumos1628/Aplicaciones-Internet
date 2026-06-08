<?php

namespace App\Http\Controllers;

use App\Models\Consumidor;
use App\Models\Gasto;
use App\Models\Ingreso;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalIngresos = Ingreso::sum('monto');
        $totalGastos = Gasto::sum('monto');
        $balance = $totalIngresos - $totalGastos;
        $consumidoresCount = Consumidor::count();

        $ultimosIngresos = Ingreso::with('consumidor')
            ->latest()
            ->take(5)
            ->get();

        $ultimosGastos = Gasto::with('consumidor')
            ->latest()
            ->take(5)
            ->get();

        $gastosPorCategoria = Gasto::select('categoria', DB::raw('SUM(monto) as total'))
            ->groupBy('categoria')
            ->orderByDesc('total')
            ->get();

        $totalPorCategoria = $gastosPorCategoria->sum('total');

        return view('dashboard', compact(
            'totalIngresos',
            'totalGastos',
            'balance',
            'consumidoresCount',
            'ultimosIngresos',
            'ultimosGastos',
            'gastosPorCategoria',
            'totalPorCategoria'
        ));
    }
}
