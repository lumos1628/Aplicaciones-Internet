<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingreso extends Model
{
    use HasFactory;

    protected $fillable = ['consumidor_id', 'monto', 'fecha', 'descripcion'];

    public function consumidor(): BelongsTo
    {
        return $this->belongsTo(Consumidor::class);
    }
}