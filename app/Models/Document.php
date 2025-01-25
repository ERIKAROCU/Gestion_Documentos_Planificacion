<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function trabajador()
    {
        return $this->belongsTo(User::class, 'trabajador_id');
    }

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'numero_documento',
        'fecha_ingreso',
        'origen',
        'titulo',
        'numero_folios',
        'detalles',
        'derivado',
        'fecha_salida',
        'trabajador_id',
        // Agregar otros campos que desees permitir
    ];

}
