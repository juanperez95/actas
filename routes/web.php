<?php

use App\Http\Controllers\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', [Pdf::class,'index'])->name('inicio');
Route::post('/PDF_OP',[Pdf::class,'pdfOperacion'])->name('pdf_operacion');
Route::post('/PDF_G',[Pdf::class,'pdfGestor'])->name('pdf_gestor');

