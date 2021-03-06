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

Route::group([
    'prefix' => 'players'
], function () {
    Route::get('/', 'PlayerController@index')->name('players');
    Route::get('/list', 'PlayerController@list')->name('players/list');
    Route::get('/fetchFromGameSpark', 'PlayerController@fetchFromGameSpark')->name('players/fetchFromGameSpark');
});

Route::group([
    'prefix' => 'tran_players'
], function () {
    Route::get('/fetchFromGameSpark', 'TranPlayerController@fetchFromGameSpark')->name('tran_players/fetchFromGameSpark');
});

Route::group([
    'prefix' => 'transactions'
], function () {
    Route::get('/fetchFromGameSpark', 'TransactionController@fetchFromGameSpark')->name('transactions/fetchFromGameSpark');
});


Route::group([
    'prefix' => 'super_agent'
], function () {
    Route::get('/upload', 'SuperAgentController@upload')->name('super_agent/upload');
    Route::post('/upload_csv', 'SuperAgentController@upload_csv')->name('super_agent/upload_csv');
    Route::get('/list', 'SuperAgentController@list')->name('super_agent/list');
});