<?php

namespace App\Http\Controllers;

use App\Models\Expediente\Archivo;
use App\Models\Expediente\Expediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Spatie\LaravelPdf\Support\pdf;

class ExpedienteController extends Controller
{
    public function download($record)
    {
        $archivo = Archivo::findOrFail($record);

        $content = Storage::disk('public')->path($archivo->ruta);
        
        return response()->download($content, $archivo->nombre_original);
    }

    //generarPDF
    public function generarPDF($record)
    {
        $expediente = Expediente::findOrFail($record);
        return pdf()
            ->view('pdf.expediente', compact('expediente'))
            ->name('Expediente N°' . $expediente->n_mesa_entrada . '.pdf');
    }

}
