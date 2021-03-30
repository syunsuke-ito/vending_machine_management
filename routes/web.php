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



Auth::routes();

// 商品一覧画面を表示
Route::get('/', 'HomeController@index')->name('home');

//検索結果を表示する
Route::get('/serch', 'HomeController@serch')->name('serch');


//商品登録画面を表示
Route::get('/create', 'HomeController@showCreate')->name('create');

//商品登録
Route::post('/store', 'HomeController@exeStore')->name('store');

// 商品詳細画面を表示
Route::get('/{id}', 'HomeController@showDetail')->name('detail');

//商品編集画面を表示
Route::get('/edit/{id}', 'HomeController@showEdit')->name('edit');


Route::post('/update', 'HomeController@exeUpdate')->name('update');

//商品削除
Route::post('/delete/{id}', 'HomeController@exeDelete')->name('delete');

