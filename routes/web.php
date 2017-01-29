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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/v1/authenticate', 'Auth\LoginController@authenticate');
Route::get('/api/v1/authenticate', 'Auth\LoginController@authenticate');

Route::get('/api/v1/teams', 'TeamController@index');
Route::post('/api/v1/team', 'TeamController@store');
Route::get('/api/v1/team/{team}/projects', 'ProjectController@teamProjects');

Route::get('/api/v1/projects', 'ProjectController@index');
Route::get('/api/v1/project/{project}', 'ProjectController@show');
Route::get('/api/v1/project/{project}/typography', 'ProjectController@typography');
Route::get('/api/v1/project/{project}/fonts', 'ProjectController@fonts');
Route::get('/api/v1/project/{project}/logos', 'ProjectController@logos');
Route::get('/api/v1/project/{project}/colors', 'ProjectController@colors');
Route::get('/api/v1/currentUser', 'ProjectController@currentUser');

Auth::routes();

Route::get('/home', 'HomeController@index');
