<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

Route::prefix('/categories')->group(function () {
    Route::get("/", [CategoryController::class, 'index'])->name('categories.index');
    Route::middleware("auth")->group(function () {
        Route::get("/create", [CategoryController::class, 'create'])->name('categories.create');
        Route::post("/", [CategoryController::class, 'store'])->name('categories.store');
        Route::get("/{category}/edit", [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put("/{category}", [CategoryController::class, 'update'])->name('categories.update');
        Route::delete("/{category}", [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});
Route::prefix('/tasks')->group(function () {
    Route::get("/", [TaskController::class, 'index'])->name('tasks.index');
    Route::middleware("auth")->group(function () {
        Route::get("/create", [TaskController::class, 'create'])->name('tasks.create');
        Route::post("/", [TaskController::class, 'store'])->name('tasks.store');
        Route::get("/{task}/edit", [TaskController::class, 'edit'])->name('tasks.edit');
        Route::patch("/{task}", [TaskController::class, 'update'])->name('tasks.update');
        Route::delete("/{task}", [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::post('/{task}/changeComplition', [TaskController::class, "changeComplition"])->name('tasks.changeComplition');
    });
});
