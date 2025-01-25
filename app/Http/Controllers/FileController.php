<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    // Subir un archivo para un documento específico
    public function store(Request $request, Document $document)
    {
        $validated = $request->validate([
            'archivo' => 'required|file|mimes:pdf,doc,docx,xlsx|max:2048',
        ]);

        $file = $request->file('archivo');
        $path = $file->store('documents');

        $document->files()->create([
            'archivo_path' => $path,
            'tipo' => $file->getClientOriginalExtension(),
        ]);

        return redirect()->route('documents.show', $document)->with('success', 'Archivo subido con éxito.');
    }

    // Descargar un archivo
    public function download(File $file)
    {
        return Storage::download($file->archivo_path);
    }

    // Eliminar un archivo
    public function destroy(File $file)
    {
        Storage::delete($file->archivo_path);
        $file->delete();

        return back()->with('success', 'Archivo eliminado con éxito.');
    }
}
