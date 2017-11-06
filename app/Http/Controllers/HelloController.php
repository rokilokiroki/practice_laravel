<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Person;
use Validator;

class HelloController extends Controller{

  public function index(Request $request){
    // return view(テンプレート , 配列)
    # $data = ['msg'=>'']の場合、 viewにはキーであるmsgという名前の変数としてテンプレートに用意されることになる。テンプレートには$msgとして渡される。
    // laravel特有のviewへの変数の渡し方である。配列にたくさんの変数をいれることによって、view側で使えるようにしている。phpでの配列の取り出し方,変数名[Key]では取り出せない。配列に入っている変数は、ただ配列にいれないとview側でつかないだけである。要は
    // $msg = 'こんにちは';
    // をview(テンプレート, $msg)として渡せないので['msg' => 'こんにちは']と連想配列の形にしないと渡せない。
    // そしてview側が見ているのはたくさんの変数が入っている配列の名前ではなく、その中に入っている変数である。
    // なので一度$data = ['msg' => 'こんにちは']というふうに連想配列に入れてreturn view(テンプレート, $data)として渡さないとならない。
    // なのでテンプレートに変数を用意したい場合は、配列に入れて連想配列の形にしなくてはならない。配達便で我々が欲しいのはダンボール（配列名）ではなく、商品（変数名）だということになる。
    // そして配列そのものを渡したい場合
    // $data =['one', 'two', 'three']という配列をviewに渡したい場合、return view(テンプレート, [data => $data])とする。
    // 今回我々が欲しいのは配列そのものなので,$data =['one', 'two', 'three']→return view(テンプレート, $data])としてview側で使いたいところを一度、配列にいれる。reutrn view(テンプレート, ['data' => $data])とする。上記のダンボールの考え方である。配達便もダンボールに包まなければ商品を送れない。return view(テンプレート, $data])だけだとreturn view(テンプレート, ['one', 'two', 'three']])が送られているだけになる。なのでreutrn view(テンプレート, ['data' => $data])として商品(変数名)をダンボール(配列)に包まなければならない。
    // reutrn view(テンプレート, ['data' => ['one', 'two', 'three']])でも大丈夫。上記の考え方と同じでこの渡し方は$data =['one', 'two', 'three']をreturn view内でしているだけ。


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

    // $items = DB::select('select * from people');
    // DB::select('実行するSQL文');
    // selectはデータベースからレコードを取り出すための処理。実行するとレコードの情報が戻り値として返される
    // $items = DB::table('people')
    //        ->orderBy('age', 'desc')
    //        ->get();
    // DB::tableは指定したテーブルのビルダを取得する。ビルダはIlluminate\Database\Query名前空間にあるBuilderクラスでSQLクエリ文を生成するための機能を提供する。DB::tableでビルダを用意して、このビルダの中野メソッドを呼び出していけばテーブルの操作が行える。get()メソッドはSQLのselect文に相当する。実行結果はCollectionになっていてこの中に取得したレコードのオブジェクトがまとめられている。引数をつければ、get([id, name])のようにすればそのカラムだけ取り出せる。
    // $items = DB::table('people')->simplePaginate(5);
    // ここで5項目ずつレコードを取り出して表示するようにする。
    // $items = DB::table(テーブル名)->simplePaginate(表示数);
    // DB::tableでテーブルを指定し、その戻り値のインスタンスからsimplePaginateメソッドを呼び出す。
    // モデルクラスでやる場合も
    // $items = DB::モデル名->simplePaginate(表示数);
    // linksメソッドも同じように使える。
        $sort = $request->sort;
        $user = Auth::user();
        // Auth::userというメソッドの戻り値を変数$userに入れて、テンプレートに渡している。
        // ログインしているユーザーのモデルインスタンスを返す。
        $items = Person::simplePaginate(10);
        // $items = Person::orderBy($sort, 'asc')
        //     ->simplePaginate(10);
        $param = ['items' => $items, 'sort' => $sort, 'user'=>$user];
        return view('hello.index', $param);
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
  //   $validate_rule = [
  //     'msg' => 'required',
  //   ];
  //   $this->validate($request, $validate_rule);
  //   $msg = $request->msg;
  //   $response = new Response(view('hello.index', ['msg' => $msg]));
  //   $response->cookie('msg',$msg,100);
  //   return $response;
  // }
    $items = DB::select('select * from people');
    return view('hello.index', ['items' => $items]);
    }

    public function add(Request $request){
        return view('hello.add');
    }

    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people(name, mail, age) values(:name, :mail, :age)', $param);
        // DB::insert('SQL実行文', パラメータ配列);
        DB::table('people')->insert($param);
        // DB::table('people')->insert(データをまとめた配列);
        // SQLクエリ文に較べてクエリビルダは書きやすい。
        return redirect('/');
    }

    public function edit(Request $request){
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id',$param);
        // where文でid=1のものをすべてとってきている。
        $item = DB::table('people')
                  ->where('id', $request->id)->first();
        return view('hello.edit',['form' => $item]);
    }

    public function update(Request $request){
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::update('update people set name = :name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')
          ->where('id', $request->id)->update($param);
        return redirect('/');
        // DB::table()->where(更新対象の指定)->update(配列);
          // update()もinsertとほとんど一緒。更新する値を連想配列にまとめる。ただinsertと違うのはどのレコードを更新するかを決め無くてはならない。whereなしてupdateするとすべてのレコードが更新される。railsでも同じだがeditでidを指定したからといってupdateメソッドの中でidを指定しなくていい理由にはならない。あくまでeditメソッドは表示するだけ。ちゃんとupdate()するならidを指定する。

    }

    public function delete(Request $request){
        $item = DB::table('people')
                  ->where('id' , $request->id)
                  ->first();
        return view('hello.delete', ['form' => $item]);
    }

    public function remove(Request $request){
        DB::table('people')
            ->where('id', $request->id)->delete();
        // DB::delete('delete from people where id = :id',$param);
        // delete from people where id = :id
        // delete文はidさえわかれば行える。
        return redirect('/');
    }

    public function show(Request $request){
        $page = $request->page;
        $items = DB::table('people')
                    ->offset($page * 3)
                    ->limit(3)
                    ->get();
        // 任意パラメータ, /show?name=〇〇のように?を付けてから利用することによってルーティングで指定されていないパラメータも渡せるようになる。
        // where()->orWhere()で条件に一つでも合致すればすべて検索させることができる。
        // where()->where()ならすべての条件に合致するものだけ検索
        // where('name', 'like', '%'.$name.'%')ではwhereでnameにlike検索の条件設定をしている。SQLではカラム like '%テキスト%'みたいに実行される。
        return view('hello.show', ['items'=> $items]);
        // where('カラム名', 値)
        // SQLのwhere句に相当する。このwhereは引数にカラム名と値を指定すると、条件に相当すするレコードを絞り込む。
        // first()
        // 最初のレコードをとってくる。get()は検索されたレコードをすべてとってくるが、first()は最初だけ。一つだけしかないものはこっちのほうがいい。
    }

    public function rest(Request $request)
    {
        return view('hello.rest');
    }

    public function ses_get(Request $request)
    {
        $sesdata = $request->session()->get('msg');
        return view('hello.session',['session_data'=> $sesdata]);
        // 値を取得する
        // $変数 = $request->session()->get(キー);
    }

    public function ses_put(Request $request)
    {
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        // 値を保存する
        // $request->session()->put(キー, 値);
        return redirect('/session');
    }

    public function getAuth(Request $request)
    {
        $param = ['message' => 'ログインして下さい'];
        return view('hello.auth', $param);
    }
    public function postAuth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password]))
            // ログイン処理はattemptメソッドで行う。
            // 引数にemail, passwordというキーをもった連想配列を渡す。
            {
            $msg = 'ログインしました。（' . Auth::user()->name . '）';
            } else {
            $msg = 'ログインに失敗しました。';
        }
        return view('hello.auth', ['message' => $msg]);
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
