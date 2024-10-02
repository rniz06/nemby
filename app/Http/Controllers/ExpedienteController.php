<?php

namespace App\Http\Controllers;

use App\Models\Expediente\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{
    // public function downloada($record)
    // {
    //     $data = Archivo::select('id', 'ruta', 'nombre_original')->where('id', $record)->first();

    //     $content = Storage::disk('public')->path($data->ruta_archivo);

    //     return response()->download($content);
    // }

    public function download($record)
    {
        $archivo = Archivo::findOrFail($record);

        $content = Storage::disk('public')->path($archivo->ruta);
        

        
        return response()->download($content, $archivo->nombre_original);
    }
}
