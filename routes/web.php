<?php

use App\Http\Controllers\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', [Pdf::class,'index'])->name('inicio');
