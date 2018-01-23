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
Route::get('/employees', 'EmployeesController@index')->middleware('auth');
Route::get('/newemployee', 'EmployeesController@newemployee')->middleware('auth');
Route::post('/newemployee', 'EmployeesController@addemployee')->middleware('auth');
Route::get('/getemployee/{id}', 'EmployeesController@getemployee')->middleware('auth');
Route::get('/getemployees','AjaxController@getemployees')->middleware('auth');
Route::get('/getdepartments','AjaxController@getdepartments')->middleware('auth');
Route::get('/getposts','AjaxController@getposts')->middleware('auth');
Route::get('/posts','PostsController@index')->middleware('auth');
Route::get('/departments','DepartmentsController@index')->middleware('auth');
Route::resource('/post','PostController')->middleware('auth');
Route::resource('/dept','DeptController')->middleware('auth');
Route::get('/about', function () {
    return view('welcome');
});
Route::post('/setemployee', 'AjaxController@setemployee')->middleware('auth');
//Route::post('/newempl', 'AjaxController@newemployee')->middleware('auth');
Route::post('/upload','AjaxController@upload')->middleware('auth');
Route::post('/dropfoto','AjaxController@dropfoto')->middleware('auth');

// Route::get('/getemployees','AjaxController@getemployees');
Auth::routes();
/*
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/