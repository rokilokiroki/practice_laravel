<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index(){

    $html = <<<EOF

    <html>
    <head>
      <title>hello/index</title>
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
      <p>コントローラー</p>
    </body>
    </html>

EOF;

    return $html;
    }
}
