<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HistoriaController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\NutricionistaController;


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

Route::get('/test', function(){
    dd("hola");
});
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {

    //Route::post('user','UserController@getAuthenticatedUser');
    Route::post('paciente',[PacienteController::class,"pacienteById"])->name("pacienteById");
    Route::post('paciente/historias',[HistoriaController::class,"historias"])->name("historias");
    Route::post('paciente/historia',[HistoriaController::class,"historia"])->name("historia");
    Route::post('pacientes',[PacienteController::class,"pacientes"])->name("pacientes");
    Route::post('nutricionista',[NutricionistaController::class,"nutricionistaById"])->name("nutricionistaById");
    Route::post('nutricionistas',[NutricionistaController::class,"nutricionistas"])->name("nutricionistas");
    

});