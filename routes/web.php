<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TarefaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/fetch-tasks', [DashboardController::class, 'fetchTasks'])
    ->name('fetch-tasks')
    ->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create', [TarefaController::class, 'create'])->name('tarefa.create');
    Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefa.store');
    Route::get('/tarefas/{id}/edit', [TarefaController::class, 'edit'])->name('tarefa.edit');
    Route::put('/tarefas/{id}', [TarefaController::class, 'update'])->name('tarefa.update');
});

require __DIR__.'/auth.php';
