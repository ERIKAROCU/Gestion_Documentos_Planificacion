<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['document_id', 'archivo_path', 'tipo', 'nombre_original'];

    // Relación con Document
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
