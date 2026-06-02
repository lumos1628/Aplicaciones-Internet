<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Consumidor;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    public function index()
    {
        $gastos = Gasto::with('consumidor')->get();
        return view('gastos.index', compact('gastos'));
    }

    public function create()
    {
        $consumidores = Consumidor::all();
        return view('gastos.create', compact('consumidores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'consumidor_id' => 'required|exists:consumidors,id',
            'monto'         => 'required|numeric|min:0',
            'fecha'         => 'required|date',
            'categoria'     => 'required|string|max:255',
            'descripcion'   => 'required|string|max:255',
        ]);

        Gasto::create($request->only('consumidor_id', 'monto', 'fecha', 'categoria', 'descripcion'));
        return redirect()->route('gastos.index')->with('success', 'Gasto creado.');
    }

    public function show(Gasto $gasto)
    {
        return view('gastos.show', compact('gasto'));
    }

    public function edit(Gasto $gasto)
    {
        $consumidores = Consumidor::all();
        return view('gastos.edit', compact('gasto', 'consumidores'));
    }

    public function update(Request $request, Gasto $gasto)
    {
        $request->validate([
            'consumidor_id' => 'required|exists:consumidors,id',
            'monto'         => 'required|numeric|min:0',
            'fecha'         => 'required|date',
            'categoria'     => 'required|string|max:255',
            'descripcion'   => 'required|string|max:255',
        ]);

        $gasto->update($request->only('consumidor_id', 'monto', 'fecha', 'categoria', 'descripcion'));
        return redirect()->route('gastos.index')->with('success', 'Gasto actualizado.');
    }

    public function destroy(Gasto $gasto)
    {
        $gasto->delete();
        return redirect()->route('gastos.index')->with('success', 'Gasto eliminado.');
    }
}