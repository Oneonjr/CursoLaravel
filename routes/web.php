<?php

use App\Http\Controllers\SeasonsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;

Route::get('/', function () {
    return redirect('/series');
});



Route::resource('/series',SeriesController::class)
    ->except(['show']);
    // ->only(['index','create','store','destroy','edit']);

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');


// Route::post('/series/destroy/{serie}',[SeriesController::class, 'destroy'])
//     ->name('series.destroy');

// Route::controller(SeriesController::class)->group(function (){
//     Route::get('/series', 'index')->name('series.index'); //ConfigurandoRota
//     Route::get('/series/criar', 'create')->name('series.create'); 
//     Route::post('/series/salvar', 'store')->name('series.store'); 
// });