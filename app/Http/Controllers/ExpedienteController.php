<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpedienteConsultaRequest;
use App\Models\Ciudadano;
use Spatie\LaravelPdf\Enums\Format;
use App\Models\Expediente\Archivo;
use App\Models\Expediente\Expediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Spatie\LaravelPdf\Support\pdf;

class ExpedienteController extends Controller
{

    /*******************************************************************
    * Mostrar formulario de consulta de un expediente para el ciudadano*
    *******************************************************************/
    public function consulta()
    {
        return view('expedientes.consultar');
    }

    /**
     * Consulta un expediente basado en el número de mesa de entrada y el CI del ciudadano.
     * 
     * Valida la solicitud y busca un expediente que coincida con los criterios proporcionados.
     * Si se encuentra el expediente, redirige a la vista de detalles; de lo contrario, 
     * retorna a la vista anterior con un mensaje de error.
     */
    public function consultar(ExpedienteConsultaRequest $request)
    {
        $validated = $request->validated();

        $expediente = Expediente::where('n_mesa_entrada', $validated['n_mesa_entrada'])
            ->whereHas('ciudadano', function ($query) use ($validated) {
                $query->where('ci', $validated['ci']);
            })
            ->first();

        if (!$expediente) {
            return back()->withErrors(['n_mesa_entrada' => 'Carpeta no encontrada.']);
        }

        return redirect()->route('expediente.detalles', ['expediente' => $expediente->id]);
    }

    /*******************************************************************
    *    Vista con que muestra los detalles del expediente consultado  *
    *******************************************************************/
    public function detalles(Expediente $expediente)
    {
        return view('expedientes.detalles', compact('expediente'));
    }

    /*******************************************************************************
    * Descarga un archivo del expediente correspondiente al registro especificado  *
    *******************************************************************************/
    public function download($record)
    {
        $archivo = Archivo::findOrFail($record);

        $content = Storage::disk('public')->path($archivo->ruta);

        return response()->download($content, $archivo->nombre_original);
    }

    /**************************************************************************
    * Genera un PDF del expediente correspondiente al registro especificado.  *
    **************************************************************************/
    public function generarPDF($record)
    {
        $expediente = Expediente::findOrFail($record);
        $responsable = $expediente->ciudadano()->first();
        $comentarios = $expediente->comentarios()->orderBy('created_at', 'desc')->get();
        $archivos = $expediente->archivos()->orderBy('created_at', 'desc')->get();
        $logo = asset('img/Logo-Escudo-de-Nemby.png');
        return pdf()
            ->view('pdf.expediente.expediente', compact('expediente', 'responsable', 'comentarios', 'archivos'))
            ->headerView('pdf.expediente.header', compact('logo'))
            ->footerView('pdf.expediente.footer')
            ->format(Format::A4)
            ->name('Expediente N°' . $expediente->n_mesa_entrada . '.pdf');
    }
}
