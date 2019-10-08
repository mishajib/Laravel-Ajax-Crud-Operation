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

Route::get('/', 'ContactController@index')->name('home');
Route::get('contacts/data', 'ContactController@getData')->name('getData');
Route::post("contacts/store", "ContactController@store")->name("store");
Route::post("contacts/update", "ContactController@update")->name("update");
Route::post("contacts/delete", "ContactController@destroy")->name("delete");
