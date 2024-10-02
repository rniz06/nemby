<?php

use App\Http\Controllers\ExpedienteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/expediente/descargar-archivo/{record}', [ExpedienteController::class, 'download'])->name('expediente.descargar.archivo');
