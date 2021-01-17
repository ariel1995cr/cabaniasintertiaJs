<?php

use App\Http\Controllers\CabinController;
use App\Http\Controllers\ConfiguracionController;
use App\Models\Configuracion;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'data' => Configuracion::where('id',1)->get()->first(),
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('configuracion', [ConfiguracionController::class, 'index'])->name('configuracion');
    Route::put('configuracion/{id}', [ConfiguracionController::class, 'update'])->name('configuracion.update');

    Route::resource('cabin', CabinController::class);
});