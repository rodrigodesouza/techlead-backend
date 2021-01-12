<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    ClienteController,
    LivroController,
    PedidoController,
};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api']], function () {
    Route::post('login', [ClienteController::class, 'login']);
    Route::post('signup', [ClienteController::class, 'signup']);
    Route::post('logout', [ClienteController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('livros', [LivroController::class, 'index']);
    Route::post('livros/solicitar', [PedidoController::class, 'solicitaLivro']);
});
