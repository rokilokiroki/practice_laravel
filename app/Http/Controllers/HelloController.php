<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class HelloController extends Controller{

  public function index(Request $request){
    # $data = ['msg'=>'']の場合、 viewにはキーであるmsgという名前の変数としてテンプレートに用意されることになる。テンプレートには$msgとして渡される。
    #viewの第二引数ではテンプレート側に用意する変数名をキーに指定して、値(value)を用意する。
    #$data = ['one','two','three','four','five'] のようにテンプレート側で配列をそのまま使いたい場合はview('hello.index',['data'=>$data]);のように配列をバリューにセットしてviewに送る。要はキーを設定しなければならない？
    // $data =[
    //   ['name'=>'山田', 'mail'=>'taro@yamada'],
    //   ['name'=>'山元', 'mail'=>'ziro@yamamoto'],
    //   ['name'=>'山義', 'mail'=>'saburo@yamagi'],
    // ];
    // dd($request->data);
    return view('hello.index');
    // middleware->controller->view
  }

  public function post(Request $request){
    #例えばview側で渡す際に$data['message']と書いてみたが、取り出せなかった。Undefined variable: dataと出た。なのでキー名として渡さなければ無理だ。
    $data = ['one','two','three','four','five'];
    return view('hello.index', ['data'=>$data],['message'=>$request->msg]);
  }
}

// global $head, $style, $body, $end;
// $head = '<html><head>';
// $style = <<<EOF
// <style>
//   body{
//     font-size:16pt;
//     color:#999;
//   }
//   h1{
//     font-size:100pt;
//     text-align:right;
//     color:#eee;
//     margin:-40px 0px -50px 0px;
//   }
// </style>
// EOF;
// $body = '</head><body>';
// $end = '</body></head>';

// function tag($tag, $txt){
//   return "<{$tag}>.$txt.</{$tag}>";
// }

// class HelloController extends Controller
// {


//     public function index(){
//       global $head, $style, $body, $end;

//       $html = $head.tag('title', 'Hello/Index').$style.$body.tag('h1', 'Index').tag('p', 'this is index page').'<a href="/other">go to other</a>'.$end;
//       return $html;
//     }

//     public function other(){
//       global $head, $style, $body, $end;

//       $html = $head.tag('title', 'Hello/Other').$style.$body.tag('h1', 'Other').tag('p', 'this is other page').'<a href="/other">this is other</a>'.$end;
//       return $html;
//     }
// }
