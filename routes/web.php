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
Route::get('/article/{nav}/{menu}?{page}', 'PageController@pages')->name('page');
Route::get('/article/{nav}/{menu}', 'MenuController@menus')->name('menu');

//排序、中介層:登入/管理員
Route::middleware('auth','admin')->group(function() {
    Route::post('navbar-sortable','NavbarController@sort')->name('navbar.sort');
    Route::post('menu-sortable','MenuController@sort')->name('menu.sort');
    Route::get('/manage/navbar/sort', function () {return view('manage.navbar.sort');});
    Route::get('/manage/menu/sort', function () {return view('manage.menu.sort');});
});

Route::prefix('manage')->middleware('auth','admin')->group(function(){
    Route::resource('member', 'MemberController');
    Route::resource('navbar', 'NavbarController');
    Route::resource('page', 'PageController');
    Route::resource('log', 'LogController');
    Route::resource('menu', 'MenuController');
});

//在各視圖中可直接使用以下參數
View::composer(['*'], function ($view) {
    if (Request::getQueryString()) {
        $current_page = App\Page::where('url', $_SERVER['QUERY_STRING'])->first();
        $view->with('current_page', $current_page);
    }
    $navbars = App\Navbar::where('is_open',1)->orderby('sort')->get();
    $users = App\User::all();
    $menus = App\Menu::where('is_open',1)->orderby('sort')->get();
    $pages = App\Page::where('is_open',1)->orderby('updated_at')->get();

    $view->with('navbars',$navbars);
    $view->with('users',$users);
    $view->with('menus',$menus);
    $view->with('pages',$pages);
});

