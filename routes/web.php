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

Route::resource('/shops','ShopController');
//Route::redirect('/','shops');

//修改
Route::patch('/editInfo/{shopuser}', 'ShopUserController@editInfo')->name('editInfo');
Route::patch('/editPwd/{shopuser}', 'ShopUserController@editPwd')->name('editPwd');


//登录
Route::get('login', 'SessionController@login')->name('login');
Route::post('login', 'SessionController@store')->name('login');
Route::delete('logout', 'SessionController@logout')->name('logout');


//菜品分类
Route::resource('/menucategorys','MenuCategoryController');
Route::get('/menucategory/{menucategory?}','MenuCategoryController@menucategory')->name('menucategory');


//菜品管理
Route::resource('/menus','MenuController');

//默认分类
Route::get('/selected/{menucategory}','MenuCategoryController@selected')->name('selected');

//活动列表
Route::get('/activitys','ActivityController@index')->name('activitys.index');
Route::get('/activitys/show/{activity}','ActivityController@show')->name('activitys.show');