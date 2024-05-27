<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\ProfileController;

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
    // Pega todos os anuncio do banco de dados
    $anuncios = \App\Models\Anuncio::all();

    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'anuncios' => $anuncios,
    ]);
})->name('home');

Route::get('/criar-anuncio', function () {
    return Inertia::render('Anuncio/CriaAnuncio');
})->middleware(['auth', 'verified'])->name('criaAnuncio');

Route::post('/criar-anuncio', [AnuncioController::class, 'store'])->middleware(['auth', 'verified'])->name('anuncios.store');
Route::get('/anuncios/delete/{anuncio}', [AnuncioController::class, 'destroy'])->middleware(['auth', 'verified'])->name('anuncios.destroy');
Route::get('/anuncios/{anuncio}', [AnuncioController::class, 'show'])->middleware(['auth', 'verified'])->name('anuncios.show');

Route::get('/perquisar-anuncios', [AnuncioController::class, 'search'])->name('anuncios.search');

Route::get('/anuncios', [AnuncioController::class, "anuncios"])->middleware(['auth', 'verified'])->name('anuncios');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
