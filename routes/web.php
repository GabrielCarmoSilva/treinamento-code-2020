<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/', function () {
        return view('admin.layouts.app');
        
    })->name('dashboard');
    
    Route::get('/home', 'HomeController@index')->name('home');

    //Usuarios
    Route::resource('/users','UserController')->names('users');

    //Categorias
    Route::resource('/categories', 'CategoryController')->names('categories');

    //Cursos
    Route::resource('/courses', 'CourseController')->names('courses');
    Route::post('/courses/register/{course}', 'CourseController@register')->name('courses.register');
    Route::get('/mycourses', 'CourseController@userCourses')->name('courses.mycourses');
});