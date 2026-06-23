<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecommendationController;


Route::get('/', function () {
    return view('home');
});

Route::post(
    '/recommend',
    [RecommendationController::class, 'process']
);
Route::get(
    '/recommend/{student}',
    [RecommendationController::class, 'generate']
);

Route::get(
    '/relation',
    [RecommendationController::class, 'relation']
);

Route::get(
    '/recommend/{student}',
    [RecommendationController::class, 'generate']
);
