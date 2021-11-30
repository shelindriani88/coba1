<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');

Route::get('surah', 'ApiController@getAllSurah');
Route::get('ayat', 'ApiController@getAyatBySurah');


Route::post('guru/save-hafalan',[
    'uses'	=>'ApiController@saveHafalan',
    'middleware' => ['jwt.verify','jwt.check'],
    'roles'	=>'guru'
]);

Route::get('guru/santri',[
    'uses'	=>'ApiController@getSantriByKelas',
    'middleware' => ['jwt.verify','jwt.check'],
    'roles'	=>'guru'
]);

Route::get('guru/kelas',[
    'uses'	=>'ApiController@getKelas',
    'middleware' => ['jwt.verify','jwt.check'],
    'roles'	=>'guru'
]);


Route::get('ortu/info-anak',[
    'uses'	=>'ApiController@getDataSiswa',
    'middleware' => ['jwt.verify','jwt.check'],
    'roles'	=>'ortu'
]);



