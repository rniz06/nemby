<?php

namespace App\Http\Controllers;

use App\Models\Expediente\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{
    public function download($record)
    {
        $archivo = Archivo::findOrFail($record);

        $content = Storage::disk('public')->path($archivo->ruta);
        
        return response()->download($content, $archivo->nombre_original);
    }
}
