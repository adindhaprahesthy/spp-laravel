<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;


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
//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});
    
    Route::post("/register", [UserController::class, 'register']);
    Route::post("/login", [UserController::class, 'login']);
    Route::get('/login_check','UserController@getAuthenticatedUser');

    Route::group(['middleware' => ['jwt.verify']], function (){
    Route::get('/login_check','UserController@getAuthenticatedUser');


        Route::group(['middleware' => ['api.superadmin']], function()
        {
            Route::delete('/kelas/{id}', 'KelasController@delete');
            Route::delete('/siswa/{id}', 'SiswaController@delete');
            Route::delete('/spp/{id}', 'SppController@delete');
            Route::delete('/petugas/{id}', 'PetugasController@delete');
            Route::delete('pembayaran/{id}', 'PembayaranController@delete');
});
        
    Route::group(['middleware'=> ['api.admin']], function()
       {    
            Route::post('/kelas', 'KelasController@store');
            Route::put('/kelas/{id}', 'KelasController@update');

            Route::post('/siswa', 'SiswaController@store');
            Route::put('/siswa/{id}', 'SiswaController@update');

            Route::post('/spp', 'SppController@store');
            Route::put('/spp/{id}', 'SppController@update');

            Route::post('/petugas', 'PetugasController@store');
            Route::put('/petugas/{id}', 'PetugasController@update');

            Route::post('/pembayaran', 'PembayaranController@store');
            Route::put('/pembayaran/{id}', 'PembayaranController@update');
   });
    
            Route::get('/kelas', 'KelasController@show');
            Route::get('/kelas/{id}', 'KelasController@detail');

            Route::get('/siswa', 'SiswaController@show');
            Route::get('/siswa/{id}', 'SiswaController@detail');    
            
            Route::get('/spp', 'SppController@show');
            Route::get('/spp/{id}', 'SppController@detail');

            Route::get('/petugas', 'PetugasController@show');
            Route::get('/petugas/{id}', 'PetugasController@detail');    

            Route::get('/pembayaran', 'PembayaranController@show');
            Route::get('/pembayaran/{id}', 'PembayaranController@detail');
    });