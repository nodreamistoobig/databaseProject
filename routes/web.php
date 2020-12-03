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

Route::get('/', function () {return view('welcome');});

Route::get('/departments', function () {return view('departments');});

Route::prefix('departments')->group(function(){
	Route::get('', 'App\Http\Controllers\DepartmentsController@index')->name('allDepartments');
	Route::post('', 'App\Http\Controllers\DepartmentsController@store');
	Route::get('create', 'App\Http\Controllers\DepartmentsController@create');	
	Route::get('{id}', 'App\Http\Controllers\DepartmentsController@show');
	Route::post('{id}', 'App\Http\Controllers\DepartmentsController@update');
	Route::get('{id}/edit', 'App\Http\Controllers\DepartmentsController@edit');
	Route::get('{id}/archive', 'App\Http\Controllers\DepartmentsController@archive');
	
	Route::get('{id}/position_create', 'App\Http\Controllers\DepartmentsController@position_create');
	Route::post('{id}/position_create', 'App\Http\Controllers\DepartmentsController@position_store');
	Route::get('{id_d}/position_edit/{id_p}', 'App\Http\Controllers\DepartmentsController@position_edit');
	Route::post('{id_d}/position_edit/{id_p}', 'App\Http\Controllers\DepartmentsController@position_update');
	Route::get('{id_d}/position_archive/{id_p}', 'App\Http\Controllers\DepartmentsController@position_archive');
	
	Route::get('{id}/room_create', 'App\Http\Controllers\DepartmentsController@room_create');
	Route::post('{id}/room_create', 'App\Http\Controllers\DepartmentsController@room_store');
	Route::get('{id_d}/room_edit/{id_r}', 'App\Http\Controllers\DepartmentsController@room_edit');
	Route::post('{id_d}/room_edit/{id_r}', 'App\Http\Controllers\DepartmentsController@room_update');
	Route::get('{id_d}/room_archive/{id_r}', 'App\Http\Controllers\DepartmentsController@room_archive');
});

Route::prefix('clients')->group(function(){
	Route::prefix('kids')->group(function(){
		Route::get('', 'App\Http\Controllers\ClientsController@kids_show')->name('allKids');
		Route::get('create', 'App\Http\Controllers\ClientsController@kid_create');
		Route::post('create', 'App\Http\Controllers\ClientsController@kid_store');
		Route::get('{id}', 'App\Http\Controllers\ClientsController@kid_show');
		Route::get('{id}/edit', 'App\Http\Controllers\ClientsController@kid_edit');
		Route::post('{id}/edit', 'App\Http\Controllers\ClientsController@kid_update');
		Route::get('{id}/archive', 'App\Http\Controllers\ClientsController@kid_archive');
		
		Route::get('{id}/parent_add', 'App\Http\Controllers\ClientsController@parent_add');
		Route::post('{id}/parent_add', 'App\Http\Controllers\ClientsController@parent_attach');
		Route::get('{id}/parent_add_existed', 'App\Http\Controllers\ClientsController@parent_add_existed');
		Route::get('{id_k}/parent_add_existed/{id_p}', 'App\Http\Controllers\ClientsController@parent_attach_existed');
		Route::get('{id_k}/parent_detach/{id_p}', 'App\Http\Controllers\ClientsController@parent_detach');
		
		Route::get('{id}/group_add', 'App\Http\Controllers\ClientsController@group_add');
		Route::get('{id_k}/group_add/{id_g}', 'App\Http\Controllers\ClientsController@group_save');
		Route::get('{id_k}/group_delete/{id_g}', 'App\Http\Controllers\ClientsController@group_delete');
	});
	
	
	Route::get('', 'App\Http\Controllers\ClientsController@clients_show')->name('allClients');
	Route::get('create', 'App\Http\Controllers\ClientsController@client_create');
	Route::post('create', 'App\Http\Controllers\ClientsController@client_store');
	Route::get('{id}/edit', 'App\Http\Controllers\ClientsController@client_edit');
	Route::get('{id}/archive', 'App\Http\Controllers\ClientsController@client_archive');
	Route::post('{id}/edit', 'App\Http\Controllers\ClientsController@client_update');
	Route::get('{id}', 'App\Http\Controllers\ClientsController@client_show');
	
	Route::get('{id}/kid_add', 'App\Http\Controllers\ClientsController@kid_add');
	Route::post('{id}/kid_add', 'App\Http\Controllers\ClientsController@kid_attach');
	Route::get('{id}/kid_add_existed', 'App\Http\Controllers\ClientsController@kid_add_existed');
	Route::get('{id_p}/kid_add_existed/{id_k}', 'App\Http\Controllers\ClientsController@kid_attach_existed');
	Route::get('{id_p}/kid_detach/{id_k}', 'App\Http\Controllers\ClientsController@kid_detach');
	
	
	
});

Route::prefix('employees')->group(function(){
	Route::get('', 'App\Http\Controllers\EmployeesController@index')->name('allEmployees');
	Route::post('', 'App\Http\Controllers\EmployeesController@store');
	Route::get('create', 'App\Http\Controllers\EmployeesController@create');	
	Route::get('{id}', 'App\Http\Controllers\EmployeesController@show');
	Route::post('{id}', 'App\Http\Controllers\EmployeesController@update');
	Route::get('{id}/edit', 'App\Http\Controllers\EmployeesController@edit');
	Route::get('{id}/archive', 'App\Http\Controllers\EmployeesController@archive');
});

Route::prefix('groups')->group(function(){
	Route::get('', 'App\Http\Controllers\GroupsController@index')->name('allGroups');
	Route::post('', 'App\Http\Controllers\GroupsController@store');
	Route::get('create', 'App\Http\Controllers\GroupsController@create');	
	Route::get('{id}', 'App\Http\Controllers\GroupsController@show');
	Route::post('{id}', 'App\Http\Controllers\GroupsController@update');
	Route::get('{id}/edit', 'App\Http\Controllers\GroupsController@edit');
	Route::get('{id}/archive', 'App\Http\Controllers\GroupsController@archive');
	
	Route::get('{id}/kid_add', 'App\Http\Controllers\GroupsController@kid_add');
	Route::get('{id_g}/kid_add/{id_k}', 'App\Http\Controllers\GroupsController@kid_save');
	Route::get('{id_g}/kid_delete/{id_k}', 'App\Http\Controllers\GroupsController@kid_delete');
});


