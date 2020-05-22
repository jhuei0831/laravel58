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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/manage', function () {return view('manage.index');})->middleware('auth','admin')->name('manage');

//排序、中介層:登入/管理員
Route::middleware('auth','admin')->group(function() {
    Route::post('navbar-sortable','NavbarController@sort')->name('navbar.sort');
    Route::get('/manage/navbar/sort', function () {return view('manage.navbar.sort');});
});

Route::prefix('manage')->middleware('auth','admin')->group(function(){
    Route::resource('member', 'MemberController');
    Route::resource('navbar', 'NavbarController');
    Route::resource('page', 'PageController');
});

//在各視圖中可直接使用以下參數
View::composer(['*'], function ($view) {
    $navbars = App\Navbar::where('is_open',1)->orderby('sort')->get();
    $users = App\User::all();

    $view->with('navbars',$navbars);
    $view->with('users',$users);
});

