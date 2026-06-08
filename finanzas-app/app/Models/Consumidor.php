<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consumidor extends Model
{
    use HasFactory;

    protected $table = 'consumidores';

    protected $fillable = ['nombre', 'email'];

    public function ingresos(): HasMany
    {
        return $this->hasMany(Ingreso::class, 'consumidorId');
    }

    public function gastos(): HasMany
    {
        return $this->hasMany(Gasto::class, 'consumidorId');
    }
}
