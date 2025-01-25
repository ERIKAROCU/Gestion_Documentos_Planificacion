<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trabajador extends Model
{
    use HasFactory;

    // Definir relación con el modelo Document
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Otros atributos y relaciones de Trabajador
}
