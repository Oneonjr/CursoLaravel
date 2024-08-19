<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Api\SeriesController;
use Illuminate\Support\Facades\Request;

Route::middleware('auth:sanctum')->get('/user',function(Request $request){
    return $request->user();
});

// Route::get('/series',[\App\Http\Api\SeriesController::class, 'index']);