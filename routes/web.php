<?php
use App\Http\Middleware\HelloMiddleware;

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
Route::get('/', 'HelloController@index')
      ->middleware(HelloMiddleware::class);
      // グローバルミドルウェアとしてkernelに登録したので消していい。
      // ->middleware('hello');でmiddleware groupのhelloグループが設定された。このルーティングにアクセスした際はhelloグループに登録してある全てのmiddlewareが実行される。
Route::post('/', 'HelloController@post');
// Route::get('/other', 'HelloController@other');
Route::get('/add', 'HelloController@add');
Route::post('/add', 'HelloController@create');
Route::get('/edit', 'HelloController@edit');
Route::post('/edit', 'HelloController@update');
Route::get('/delete', 'HelloController@delete');
Route::post('/delete', 'HelloController@remove');
Route::get('/show', 'HelloController@show');
Route::get('person', 'PersonController@index');
Route::get('/person/find','PersonController@find');
Route::post('/person/find', 'PersonController@search');
Route::get('person/add', 'PersonController@add');
Route::post('person/add', 'PersonController@create');
Route::get('person/edit', 'PersonController@edit');
Route::post('person/edit', 'PersonController@update');
Route::get('person/delete', 'PersonController@delete');
Route::post('person/delete', 'PersonController@remove');
Route::get('board', 'BoardController@index');
Route::get('board/add', 'BoardController@add');
Route::post('board/add', 'BoardController@create');
