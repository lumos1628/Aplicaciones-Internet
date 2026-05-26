<?php

namespace App\Http\Controllers;

use App\Models\Estrella;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstrellaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'num_estrellas' => 'required|integer|between:1,5',
        ]);

        // Si el usuario ya calificó el post, actualiza; si no, lo crea (updateOrCreate)
        Estrella::updateOrCreate(
            [
                'post_id' => $request->post_id,
                'user_id' => Auth::id(),
            ],
            [
                'num_estrellas' => $request->num_estrellas,
            ]
        );

        return redirect()->back()->with('success', '¡Valoración guardada correctamente!');
    }
}