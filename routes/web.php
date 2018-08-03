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

//图片上传
Route::post('upload',function (){
    $storage=\Illuminate\Support\Facades\Storage::disk('oss');
    $fileName=$storage->putFile('upload',request()->file('file'));
    return ['fileName'=>$storage->url($fileName)];
})->name('upload');

//统计
Route::get('/orders/count','OrderController@count')->name('orders.count');
//按天统计
Route::get('/orders/day','OrderController@day')->name('orders.day');
//按月统计
Route::get('/orders/month','OrderController@month')->name('orders.month');


//订单管理
Route::get('/orders','OrderController@index')->name('orders.index');
Route::get('/orders/{order}','OrderController@show')->name('orders.show');
Route::get('/orders/cancel/{order}','OrderController@cancel')->name('orders.cancel');
Route::get('/orders/send/{order}','OrderController@send')->name('orders.send');

//抽奖活动
Route::get('/events','EventController@index')->name('events.index');
Route::get('/events/{event}','EventController@show')->name('events.show');
//报名
Route::get('/signup','EventController@signup')->name('events.signup');
//查看中奖列表
Route::get('/eventprizes','EventPrizeController@index')->name('eventprizes.index');
