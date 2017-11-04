<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;


class PersonController extends Controller
{
  public function index(Request $request)
  {

    $items = Person::all();
    // all()で全レコードを取得できる。all()でまとめられているのはIlluminate\Database\Eloquent名前空間のCollectionクラスのインスタンス。レコード管理専用のコレクションクラス。DBクラスの場合、コレクションにまとめられているのは配列だったが、今回の例では一つ一つのレコードはPersonクラスのインスタンス。なのでコントローラーに渡る前にモデルで処理を追加できる。
    return view('person.index',['items' => $items]);
    // $hasItems = Person::has('boards')->get();
    // $noItems = Person::doesntHave('boards')->get();
    // $param = ['hasItems' => $hasItems, 'noItems' => $noItems];
    // return redirect('person.index', $param);
  }

  public function find(Request $request)
  {
    return view('person.find',['input'=>'']);
  }

  public function search(Request $request)
  {
    // $item = Person::find($request->input);
    // dd(Person::where('name', $request->name));
    $min = $request->input * 1;
    $max = $min + 10;
    $item = Person::ageGreaterThan($min)->ageLessThan($max)->first();
    // $item = Person::nameEqual($request->input)->first();
    // 第一引数$queryを用意する必要はない。nameEqual(名前)というように呼び出せばnameが指定ｓちあ名前に絞り込んだビルダが得られる。
    // 複数のレコードを得る。
    // $変数 = モデルクラス:: where(フィールド名, 値)->get();
    // 最初のレコードだけ取る。
    // $変数 = モデルクラス:: where(フィールド名, 値)->first();
    $param = ['input' => $request->input, 'item' => $item];
    return view('person.find', $param);
  }

  public function add(Request $request)
  {
    return view('person.add');
  }

  public function create(Request $request)
  {
    // モデルの新規保存、その他アクション。
    // Eloguentではレコードはモデルのインスタンスとして扱われる。ということは、新たにレコードを作成したい場合はモデルのインスタンスを作成し、保存するというやりかたになる。レコードの編集もインスタンスの編集（モデルの編集）になる。
    $this->validate($request, Person::$rules);
    // バリデーションは$requestそのものを引数に指定すれば、そこにある様々な値をチェックする。第二引数にPersonクラスの静的プロパティ$rulesを指定してある。モデルにルールなどを保管しておけばこのように必要に応じて取り出し、処理することができます。
    $person = new Person;
    // Personインスタンスをnewで作成。
    $form = $request->all();
    unset($form['_token']);
    // フォームに追加される非表示フィールド[_token]だけはunsetで削除しておく。
    // _tokenという値は、CSRF用非表示フィールドとして用意される項目です。これ自身はテーブルにはない項目なので削除しておく。
    $person->fill($form)->save();
    // フォームの値がまとめられた$formを引数にしてfillメソッドを呼び出す。このfillは引数に用意されている配列の値をモデルのプロパティに代入するもの。フォームのようにまとまった値がある場合は、fillを使うことで、個々のプロパティをまとめて設定できる。後はsaveメソッドでインスタンスを保存する。
    // もちろん
    // $person = new Person;
    // $person->name = $request->name;
    // $person->save();
    // のように一つ一つインスタンスを設定してもいい。
    return redirect('/person');
  }

  public function edit(Request $request)
  {
    $person = Person::find($request->id);
    return view('person.edit', ['form' => $person]);
  }

  public function update(Request $request)
  {
    $this->validate($request, Person::$rules);
    $person = Person::find($request->id);
    // findメソッドで引数$request->idでインスタンスを用意する。
    // findでインスタンスを取得し、fillで送信されたフォームの内容を反映し、saveを呼び出す。これで更新が出来る
    $form = $request->all();
    unset($form['_token']);
    $person->fill($form)->save();
    return redirect('/person');
  }

  public function delete(Request $request)
  {
    $person = Person::find($request->id);
    return view('person.delete', ['form' => $person]);
  }

  public function remove(Request $request)
  {
    Person::find($request->id)->delete();
    return redirect('/person');
  }

}


