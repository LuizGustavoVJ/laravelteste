<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\QueueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/import', [DocumentController::class, 'showImportForm']);
Route::post('/import', [DocumentController::class, 'import']);

Route::get('/process-queue', [QueueController::class, 'showProcessQueueForm']);
Route::post('/process-queue', [QueueController::class, 'processQueue']);
