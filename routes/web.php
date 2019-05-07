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
/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

/*Route::get('/about', function () {
    return view('pages.about');
});*/
##insert dynamic values into the url
/*Route::get('/users/{id}/{name}', function ($id, $name) {
    return 'this is user '.$name.' with id '.$id;
});*/

Route::resource('posts', 'PostsController');
Auth::routes();

Route::get('/home', 'DashboardController@index')->name('home'); ## line added wen we ran the artisan to enable authantication
Route::get('/dashboard', 'DashboardController@index');
Route::post('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function(){
    ##named routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');## more significant route at the bottom  
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});

//Route::get('/manage', 'UsersController@index');
Route::resource('manage', 'UsersController');
//Route::get('/manage/show/{id}', 'UsersController@index')->name('manage.show');;
Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
