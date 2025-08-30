<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::prefix('/categories')->group(function(){
    Route::get("/", [CategoryController::class, 'index'])->name('category.index');
    Route::get("/create", [CategoryController::class, 'create'])->name('category.create');
    Route::post("/", [CategoryController::class, 'store'])->name('category.store');
    Route::get("/{category}/edit", [CategoryController::class, 'edit'])->name('category.edit');
    Route::put("/{category}", [CategoryController::class, 'update'])->name('category.update');
    Route::delete("/{category}", [CategoryController::class, 'destroy'])->name('category.destroy');
});
