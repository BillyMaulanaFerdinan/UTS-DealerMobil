<?php

use App\Http\Controllers\MobilController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [WelcomeController::class, 'index']);

Route::group(   
    ['prefix' => 'mobil'],
    function () {
        Route::get('/', [MobilController::class, 'index']);
        Route::post('/list', [MobilController::class, 'list']);
        Route::get('/{id}/show_ajax', [MobilController::class, 'show_ajax']);
        Route::get('/create_ajax', [MobilController::class, 'create_ajax']);
        Route::post('/ajax', [MobilController::class, 'store_ajax']);
        Route::get('/{id}', [MobilController::class, 'show']);
        Route::get('/{id}/edit_ajax', [MobilController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [MobilController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [MobilController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [MobilController::class, 'delete_ajax']);
    }
);
