<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ScopePerson;


class Person extends Model
{


    protected $guarded = array('id');
    // $guardedというプロパティは、値を用意しておかない項目。
    // プライマリーキーであるidカラムはデータベース側で自動的に番号を割り振るのでモデルを作成する際に値は必要ない。
    // idを$guardedに設定しておくことで値がnullであってもエラーなく動作する。
    public static $rules = array(
      'name' => 'required',
      'mail' => 'email',
      'age' => 'integer|min:0|max:150'
    );
    // 他でも使った静的プロパティ$rulesはバリデーションのルールをまとめたもの。バリデーションのルールはこのようにモデルに用意した方が便利。


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopePerson);
        // static::addGlobalScopeメソッドの引数に、new ScopePersonを指定する。こうすることで、ScopePersonがグローバルスコープとして追加される。
        // static::addGlobalScope('age', function (Builder $builder) {
        //    $builder->where('age', '>', 20);
        // });
    }

    public function getData(){
      return $this->id. ':'.$this->name. '('.$this->age.')';
      // コントローラーに渡る前にモデルクラスで先に処理を追加して、機能を拡張できる。
    }

    public function scopeNameEqual($query, $str){
      // dd($query);
      return $query->where('name', $str);
      // $item = Person::nameEqual($request->input)->first();
      // メソッドを呼び出す時は最初のscopeは不要。$strにはPerson::nameEqual($request->input)の引数である$request->inputが入っている。$queryはwhereで取得されるのと全く同じBuilderインスタンスが入っている。
      // Person(モデルクラス)::where()をdd()で調べてみたらbuilderインスタンスとして返ってきていた。$queryはモデルクラスのようなもの。それをwhere()で検索している。
    }

    public function scopeAgeGreaterThan($query, $n){
      return $query->where('age','>=',$n);
    }
    public function scopeAgeLessThan($query, $n){
      return $query->where('age', '<=', $n);
    }

    public function boards()
    {
      // return $this->hasOne('App\Board');
      // hasOneメソッドは2つのテーブルが一対一の関係で関連付けられているものをいう。hasOneは主テーブルから、それに関連する従テーブルを取得するための機能。
      // リレーションを利用するにはモデルクラスの中にメソッドを追加する。
      return $this->hasMany('App\Board');
      // hasOneだと一人の利用者につき、一つの投稿しか表示できない。なぜなら一対一の関係だから。
      // hasManyだとその利用者の投稿をすべて取得できる。railsと一緒の考え方。一対多の関係。
      // hasManyはhasOneと同様、主テーブル側に用意するリレーション。これにより主テーブルのレコードと関連する、複数の従テーブルレコードに関連付ける事ができる。
    }

}

// peopleテーブルのpeopleは複数系、personは単数形。モデルは単数形にしなくてはならない。railsと一緒。
// この命名規則に従って名前をつけると、テーブルとモデルは自動的に関連付けて動くようになる。今回personモデルを後から作ったが、ちゃんと関連付けて動いている。

// モデルのスコープ
// スコープとは全体の中でどこからどこまでの範囲かを特定するためのもの。
// モデルの範囲を特定するためのもの。もし複雑な検索をする場合、where()だけをつなぎあわせて検索するのは非常にわかりずらい。そこでモデルに「こういう条件のもの」といったスコープを設定するメソッドを用意して、それを利用して細かな条件を設定した検索をわかりやすく行えるようにしよう、というわけである。
// 例えば「今月登録された20歳以上の女性の会員の山田さん」を検索するのは、複雑な条件を想像してしまうが、モデルの中に「今月登録した人」「20歳以上の人」「女性のみ」といたスコープが用意されていれば、whereで検索するのは「名前が山田」という条件だけでいい。
// スコープには大きく分けて二つある。ローカルスコープとグローバルスコープである。
// ローカルスコープ
// ローカルスコープはモデル内にメソッドを用意しておき、必要に応じてそれらのメソッドを明示的に呼び出して条件を絞り込む。メソッドを呼び出さなければスコープは機能しない。
// public function scope名前($query, 引数)
// {
  // 必要な処理
  // return 絞り込むビルダ;
// }
// スコープを定義するためのメソッドは必ずメソッド名の初めにscopeがつく。
// 第一引数には$queryが渡される。クエリビルダインスタンスが渡される。その他に引数を用意する場合は$queryの後に用意する。
// グローバルスコープ
// 処理を用意しておけば、そのモデルでのすべてのレコード取得にそのスコープが適用される。
//     protected static function boot()
    // {
    //   parent::boot();
    //   // 初期化処理
    //   static::addGlobalScope('age', function(Builder $builder){
    //     $builder->where('age', '>', 20);
    //   });
    // }
// staticなので静的メソッド。モデルインスタンス自信（$this）を利用することはできない。
// addGlobalScopeはその名の通りグローバルスコープを追加するメソッド。これをオーバーライドすることでグローバルスコープを追加できる。第一引数にメソッド名、第二引数にクロージャーを用意。
