<?php

use App\Http\Controllers\ExpedienteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Descargar archivos relacionados al expediente en la tabla expediente_archivos
Route::get('/expediente/descargar-archivo/{record}', [ExpedienteController::class, 'download'])->name('expediente.descargar.archivo');
// Generar un reporte pdf de un expediente
Route::get('/expediente/generar-pdf/{record}', [ExpedienteController::class, 'generarPDF'])->name('expediente.generar.pdf');