<?php

//use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {return view('start');});

Route::prefix('groups')->group(function(){
	Route::get('', 'App\Http\Controllers\GroupsController@index')->name('allGroups');
	Route::get('create', 'App\Http\Controllers\GroupsController@create');
	Route::post('', 'App\Http\Controllers\GroupsController@store');
	Route::get('{id}', 'App\Http\Controllers\GroupsController@show');
	Route::get('{id}/edit', 'App\Http\Controllers\GroupsController@edit');
	Route::post('{id}', 'App\Http\Controllers\GroupsController@update')->name('Group');
	Route::get('{id}/lessons', 'App\Http\Controllers\GroupsController@lesson_create');
	Route::post('{id}/lessons', 'App\Http\Controllers\GroupsController@lesson_store');
	Route::get('{id}/lesson_delete/{id_l}', 'App\Http\Controllers\GroupsController@lesson_delete');
	
});

Route::prefix('programs')->group(function(){
	Route::get('', 'App\Http\Controllers\ProgramsController@index')->name('allPrograms');
	Route::post('', 'App\Http\Controllers\ProgramsController@store');
	Route::get('create', 'App\Http\Controllers\ProgramsController@create');	
	Route::get('{id}', 'App\Http\Controllers\ProgramsController@show');
	Route::post('{id}', 'App\Http\Controllers\ProgramsController@update');
	Route::get('{id}/edit', 'App\Http\Controllers\ProgramsController@edit');
});

Route::prefix('schools')->group(function(){
	Route::get('', 'App\Http\Controllers\SchoolsController@index')->name('allSchools');
	Route::post('', 'App\Http\Controllers\SchoolsController@store');
	Route::get('create', 'App\Http\Controllers\SchoolsController@create');	
	Route::get('{id}', 'App\Http\Controllers\SchoolsController@show');
	Route::post('{id}', 'App\Http\Controllers\SchoolsController@update');
	Route::get('{id}/edit', 'App\Http\Controllers\SchoolsController@edit');
	Route::get('{id}/classroom_create', 'App\Http\Controllers\SchoolsController@classroom_create');
	Route::post('{id}/classroom_create', 'App\Http\Controllers\SchoolsController@classroom_store');
	Route::get('{id_s}/classroom_edit/{id_c}', 'App\Http\Controllers\SchoolsController@classroom_edit');
	Route::post('{id_s}/classroom_edit/{id_c}', 'App\Http\Controllers\SchoolsController@classroom_update');
});

Route::prefix('staff')->group(function(){
	Route::get('', 'App\Http\Controllers\StaffController@index')->name('allStaff');
	Route::post('', 'App\Http\Controllers\StaffController@store');
	Route::get('create', 'App\Http\Controllers\StaffController@create');
	Route::get('{id}', 'App\Http\Controllers\StaffController@show');
	Route::get('{id}/edit', 'App\Http\Controllers\StaffController@edit');
	Route::post('{id}', 'App\Http\Controllers\StaffController@update');
	
});



