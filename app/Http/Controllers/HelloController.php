<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Illuminate\Support\Facades\DB;
use Validator;

class HelloController extends Controller{

  public function index(Request $request){
    # $data = ['msg'=>'']の場合、 viewにはキーであるmsgという名前の変数としてテンプレートに用意されることになる。テンプレートには$msgとして渡される。
    #viewの第二引数ではテンプレート側に用意する変数名をキーに指定して、値(value)を用意する。
    #$data = ['one','two','three','four','five'] のようにテンプレート側で配列をそのまま使いたい場合はview('hello.index',['data'=>$data]);のように配列をバリューにセットしてviewに送る。要はキーを設定しなければならない？
    // if ($request->hasCookie('msg'))
    // {
    //   $msg = 'Cookie:'.$request->cookie('msg');
    // } else {
    //   $msg = 'クッキーなし婆';
    // }
    // $validator = Validator::make($request->query(),[
    //   'id' => 'required',
    //   'pass' => 'required',
    // ]);
    // if ($validator->fails()) {
    //   $msg = 'クエリーに問題があります';
    // } else {
    //   $msg = 'ID/PADDを受け付けました';
    // }
    $items = DB::select('select * from people');
    return view('hello.index', ['items' => $items]);
    // middleware->controller->view
  }

  public function post(Request $request){
    #例えばview側で渡す際に$data['message']と書いてみたが、取り出せなかった。Undefined variable: dataと出た。なのでキー名として渡さなければ無理だ。
    // $validator = Validator::make(値の配列 , ルールの配列, エラーメッセージ);
    // バリデータはフォーム以外の値をチェックするのにも使える。例えばクエリなど。
    // $rules = [
    //   'name' => 'required',
    //   'mail' => 'email',
    //   'age' => 'numeric',
    // ];
    // $messages = [
    //   'name.required' => '名前は必ず入力',
    //   'mail.email' => 'メールは必要',
    //   'age.numeric' => '年齢は整数で',
    //   'age.min' => '年齢はゼロ歳以上',
    //   'age.max' => '年齢は200歳以下で記入下さい',
    // ];

    // $validator = Validator::make($request->all(),$rules, $messages);

    // $validator->sometimes('age', 'min:0', function($input){
    //   return !is_int($input->age);
    // });
    // $validator->sometimes(項目名, ルール名, クロージャー);
    // 必要に応じてルールを追加したい場合、sometimes()メソッドを使えばいい。
    // クロージャーのfunctuion($input)の引数$inputには入力された値をまとめたものが渡される。returnで戻される戻り値はルールを追加するかどうかの真偽値になる。trueの場合は何もしないがfalseの場合はsometimesで指定したルールを指定の項目に追加する。
    // $validator->sometimes('age', 'max:200', function($input){
    //   return !is_int($input->age);
    // });

    // if ($validator->fails()) {
    //   return redirect('/')->withErrors($validator)->withInput();
      // withErrors()で引数にvalidatorインスタンスを渡している。これによりこのvalidatorで発生したエラーメッセージをリクエスト先まで引き継げる。withInputでは送信されたフォームの値をそのまま引き継げる。
    // }
    $validate_rule = [
      'msg' => 'required',
    ];
    $this->validate($request, $validate_rule);
    $msg = $request->msg;
    $response = new Response(view('hello.index', ['msg' => $msg]));
    $response->cookie('msg',$msg,100);
    return $response;
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
