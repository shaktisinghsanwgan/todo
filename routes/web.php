<?php

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

Route::get('/','WelcomeController@index')->name('welcome');
Route::post('/fetchAllTodo', 'WelcomeController@fetchAllTodo')->name('todo.fetchAllTodo');
Route::get('/todo/view/{id}', 'WelcomeController@view')->name('todo.view');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/todo')->group(function () {
    Route::get('/add', 'TodoController@create')->name('todo.add')->middleware('ChkAdmin');
	Route::post('/add', 'TodoController@store')->name('todo.save')->middleware('ChkAdmin');
    Route::post('/saveSubTask', 'TodoController@saveSubTask')->name('todo.saveSubTask')->middleware('ChkAdmin');
    Route::post('/fetchAllSubTask', 'TodoController@fetchAllSubTask')->name('todo.fetchAllSubTask');
    Route::post('/saveSubTaskTimeLine', 'TodoController@saveSubTaskTimeLine')->name('todo.saveSubTaskTimeLine');
    Route::post('/saveTaskTimeLine', 'TodoController@saveTaskTimeLine')->name('todo.saveTaskTimeLine');
    Route::post('/deleteTask', 'TodoController@deleteTask')->name('todo.deleteTask');
    Route::post('/assignTask', 'TodoController@assignTask')->name('todo.assignTask');

	Route::post('/deleteSubTask', 'TodoController@deleteSubTask')->name('todo.deleteSubTask')->middleware('ChkAdmin');
	Route::post('/fetchSubTask', 'TodoController@fetchSubTask')->name('todo.fetchSubTask');
	Route::delete('/delete/{id}', 'TodoController@destroy')->name('todo.destroy')->middleware('ChkAdmin');
	Route::get('/edit/{id}', 'TodoController@edit')->name('todo.edit')->middleware('ChkAdmin');
	Route::match(['put', 'patch'], '/edit/{id}', 'TodoController@update')->name('todo.update')->middleware('ChkAdmin');
	Route::get('/', 'TodoController@index')->name('todo.index');
});
Route::prefix('/user')->group(function () {
    Route::get('/add', 'UserController@create')->name('user.add')->middleware('ChkAdmin');
	Route::post('/add', 'UserController@store')->name('user.create')->middleware('ChkAdmin');
	Route::delete('/delete', 'UserController@destroy')->name('user.destroy')->middleware('ChkAdmin');
	Route::get('/view/{id}', 'UserController@show')->name('user.view')->middleware('ChkAdmin');
	Route::get('/edit/{id}', 'UserController@edit')->name('user.edit')->middleware('ChkAdmin');
	Route::match(['put', 'patch'], '/edit/{id}', 'UserController@update')->name('user.update')->middleware('ChkAdmin');
	Route::get('/', 'UserController@index')->name('user.index')->middleware('ChkAdmin');
});


