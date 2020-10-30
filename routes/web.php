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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','HomeController@index');


Auth::routes();



//Website frontend rout
//Route::get('/',function (){
//    return view('website.home');
//})->name('website');

Route::get('/about',function (){
    return view('website.about');
})->name('about');

Route::get('/category',function (){
    return view('website.category');
})->name('category');

Route::get('/contact',function (){
    return view('website.contact');
})->name('contact');

Route::get('/post',function (){
    return view('website.post');
})->name('post');

//admin panel
//Route::get('/admin-home',function (){
//    return view('admin.dashboard.index');
//})->name('admin');
//
//Route::group(['prefix'=>'admin','middleware'=>['auth']],function (){
//
//    Route::get('/home', 'HomeController@index')->name('home');
//    Route::resource('/category', 'Category\CategoryController');
//    Route::resource('/post', 'Post\PostController');
//
//});

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard','admin.dashboard.index');
});

//website router
Route::view('/', 'website.home');
