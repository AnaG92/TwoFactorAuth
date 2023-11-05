<?php

use App\Http\Controllers\TwoFaController;
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

Route::get('/', [TwoFaController::class, 'index'])->name('index');
Route::post('/', [TwoFaController::class, 'store'])->name('store');
Route::get('/code', [TwoFaController::class, 'setCode'])->name('setCode');
Route::post('/code/validate', [TwoFaController::class, 'validateCode'])->name('validateCode');
Route::get('/code/{id}/success', [TwoFaController::class, 'successCode'])->name('successCode');
