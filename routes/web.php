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
use Illuminate\Support\Facades\Input;

Route::get('/', 'IndexController@index');
Route::get('/employees', 'EmployeesController@index');
Route::get('/employees', 'EmployeesController@index');
Route::get('/getemployee/{id}', 'EmployeesController@getemployee')->middleware('auth');
Route::get('/about', function () {
    return view('welcome');
});

// Route::get('/getemployees','AjaxController@getemployees');
Auth::routes();
/*
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/