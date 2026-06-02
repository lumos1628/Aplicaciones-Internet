<?php

namespace App\Http\Controllers;

use App\Models\Consumidor;
use Illuminate\Http\Request;

class ConsumidorController extends Controller
{
    public function index()
    {
        $consumidores = Consumidor::all();
        return view('consumidores.index', compact('consumidores'));
    }

    public function create()
    {
        return view('consumidores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email'  => 'required|email|unique:consumidors,email',
        ]);

        Consumidor::create($request->only('nombre', 'email'));
        return redirect()->route('consumidores.index')->with('success', 'Consumidor creado.');
    }

    public function show(Consumidor $consumidor)
    {
        return view('consumidores.show', compact('consumidor'));
    }

    public function edit(Consumidor $consumidor)
    {
        return view('consumidores.edit', compact('consumidor'));
    }

    public function update(Request $request, Consumidor $consumidor)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email'  => 'required|email|unique:consumidors,email,' . $consumidor->id,
        ]);

        $consumidor->update($request->only('nombre', 'email'));
        return redirect()->route('consumidores.index')->with('success', 'Consumidor actualizado.');
    }

    public function destroy(Consumidor $consumidor)
    {
        $consumidor->delete();
        return redirect()->route('consumidores.index')->with('success', 'Consumidor eliminado.');
    }
}