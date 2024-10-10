<?php

namespace App\Http\Controllers;

use Spatie\LaravelPdf\Enums\Format;
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
        $responsable = $expediente->ciudadano()->first();
        $comentarios = $expediente->comentarios()->orderBy('created_at', 'desc')->get();
        $archivos = $expediente->archivos()->orderBy('created_at', 'desc')->get();
        return pdf()
            ->view('pdf.expediente.expediente', compact('expediente', 'responsable', 'comentarios', 'archivos'))
            ->headerView('pdf.expediente.header')
            ->footerView('pdf.expediente.footer')
            ->format(Format::A4)
            ->name('Expediente N°' . $expediente->n_mesa_entrada . '.pdf');
    }

}
