<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/', function () {
    return redirect()->route('recipes.index');
});


Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');



Route::middleware('demo.auth')->group(function () {
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');

    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');

    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');

    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');

    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
});


Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');



Route::get('login-demo', function (Request $request) {
    $request->session()->put('logged_in', true);
    return redirect('/recipes')->with('success', 'logged in!');
})->name('login-demo');

Route::get('/logout-demo', function (Request $request) {
    $request->session()->forget('logged_in');
    return redirect('/recipes')->with('success', 'Logged out!');
})->name('logout-demo');
