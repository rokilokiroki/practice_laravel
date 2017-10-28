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
Route::get('/{msg?}',function($msg='no message'){
  #第一引数の{msg}が第二引数に用意されている$msg引数に渡されるZET
  #Route::get('hello/{id}/{pass}',function($id,$pass))みたいな感じに２つのパラメータ引数を容易に用意できる
$html = <<<EOF

<html>
<head>
  <title>hello!</title>
</head>
<style>
  body{
    font-size:16pt;
    color:#999;
  }
  h1{
    font-size:100pt;
    text-align:right;
    color:#eee;
    margin:-40px 0px -50px 0px;
  }
</style>
<body>
  <h1>hello!</h1>
  <p>this is sample page</p>
  <p>{$msg}</p>
</body>
</html>
EOF;

  return $html;
});

