<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SimuladorController;
use App\Http\Controllers\PreevaluacionController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\AnalistaController;
use Illuminate\Support\Facades\File;



Route::get('/', function () {
    return auth()->guard()->check()
        ? redirect()->route('home')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/simulador', [SimuladorController::class, 'index'])->name('simulador.index');
    Route::post('/simulador', [SimuladorController::class, 'calcular'])->name('simulador.calcular');
});

Route::middleware('auth')->group(function () {
    Route::get('/preevaluacion', [PreevaluacionController::class, 'index'])->name('preevaluacion.index');
    Route::post('/preevaluacion', [PreevaluacionController::class, 'store'])->name('preevaluacion.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
});

Route::middleware(['auth', 'es.analista'])->group(function () {
    Route::get('/panel-analistas', [AnalistaController::class, 'index'])->name('analista.index');
    Route::patch('/panel-analistas/{id}', [AnalistaController::class, 'update'])->name('analista.update');
});

require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Ruta protegida para servir documentos (requiere autenticación)
Route::middleware('auth')->get('/documentos/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);

    if (!File::exists($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath);
})->where('path', '.*')->name('documentos.show');