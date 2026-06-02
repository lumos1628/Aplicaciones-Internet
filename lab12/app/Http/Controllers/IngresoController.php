<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Consumidor;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index()
    {
        $ingresos = Ingreso::with('consumidor')->get();
        return view('ingresos.index', compact('ingresos'));
    }

    public function create()
    {
        $consumidores = Consumidor::all();
        return view('ingresos.create', compact('consumidores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'consumidor_id' => 'required|exists:consumidors,id',
            'monto'         => 'required|numeric|min:0',
            'fecha'         => 'required|date',
            'descripcion'   => 'required|string|max:255',
        ]);

        Ingreso::create($request->only('consumidor_id', 'monto', 'fecha', 'descripcion'));
        return redirect()->route('ingresos.index')->with('success', 'Ingreso creado.');
    }

    public function show(Ingreso $ingreso)
    {
        return view('ingresos.show', compact('ingreso'));
    }

    public function edit(Ingreso $ingreso)
    {
        $consumidores = Consumidor::all();
        return view('ingresos.edit', compact('ingreso', 'consumidores'));
    }

    public function update(Request $request, Ingreso $ingreso)
    {
        $request->validate([
            'consumidor_id' => 'required|exists:consumidors,id',
            'monto'         => 'required|numeric|min:0',
            'fecha'         => 'required|date',
            'descripcion'   => 'required|string|max:255',
        ]);

        $ingreso->update($request->only('consumidor_id', 'monto', 'fecha', 'descripcion'));
        return redirect()->route('ingresos.index')->with('success', 'Ingreso actualizado.');
    }

    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();
        return redirect()->route('ingresos.index')->with('success', 'Ingreso eliminado.');
    }
}