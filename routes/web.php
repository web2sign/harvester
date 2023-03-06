<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

*/


use App\Http\Controllers\InvoiceController;

Route::get('/', [InvoiceController::class,'index']);
Route::post('update', [InvoiceController::class,'update']);
Route::post('generate', [InvoiceController::class,'generate']);
