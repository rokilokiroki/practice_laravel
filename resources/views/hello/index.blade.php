@extends('layouts.helloapp')
<style>
    .pagination { font-size:12pt; }
    .pagination li { display:inline-block }
    tr th a:link { color: white; }
    tr th a:visited { color: white; }
    tr th a:hover { color: white; }
    tr th a:active { color: white; }
</style>
@section('title','Index')
@section('menubar')
  @parent

  インデックスページ
@endsection
<!-- Auth::checkは現在アクセスしているユーザーがログインしているかを確認するもの。 -->
@section('content')
    @if (Auth::check())
    <p>USER: {{$user->name . ' (' . $user->email . ')'}}</p>
    @else
    <p>※ログインしていません。（<a href="/login">ログイン</a>｜
        <a href="/register">登録</a>）</p>
    @endif
  <p>ここが本文のコンテンツです</p>
  <p>必要なだけ記述できます</p>
  @if(count($errors) > 0)
  <!-- $errorsはバリデーションで発生したエラーメッセージをまとめて管理するオブジェクト -->
  <p>問題発生。直ちに対処</p>
  @endif
  <table>
  <tr><th>Name: </th><th>Mail</th><th>age</th></tr>
  <tr>
    <th><a href="/?sort=name">name</a></th>
    <th><a href="/?sort=mail">mail</a></th>
    <th><a href="/?sort=age">age</a></th>
  </tr>
  @foreach ($items as $item)
    <tr>
        <td>{{$item->name}}</td>
        <td>{{$item->mail}}</td>
        <td>{{$item->age}}</td>
    </tr>
  @endforeach
  <!-- <form action="/" method="post" accept-charset="utf-8"> -->
    <!-- $errors->has()でエラーが発生しているかチェック。そして$errors->first()で指定した項目の最初のエラーメッセージをとる。複数のエラーメッセージがある場合はget()でとってくる。get()はエラーメッセージをすべて配列でとってくる。first()は文字列 -->
<!--     {{ csrf_field() }}
    @if($errors->has('msg'))
    <tr><th>Error: </th><td>{{$errors->first('msg')}}</td></tr>
    @endif
    <tr><th>Message: </th><td><input type="text" name="msg" value="{{old('msg')}}"></td></tr> -->
<!--     @if($errors->has('name'))
    <tr><th>Error: </th><td>{{$errors->first('name')}}</td></tr>
    @endif
    <tr><th>name: </th><td><input type="text" name="name" value="{{old('name')}}"></td></tr>
    @if($errors->has('mail'))
    <tr><th>Error: </th><td>{{$errors->first('mail')}}</td></tr>
    @endif
    <tr><th>mail: </th><td><input type="text" name="mail" value="{{old('mail')}}"></td></tr>
    @if($errors->has('name'))
    <tr><th>Error: </th><td>{{$errors->first('age')}}</td></tr>
    @endif
    <tr><th>age: </th><td><input type="text" name="age" value="{{old('age')}}"></td></tr> -->
    <!-- value="{{old('name')}}"はフォームのフィールドに前回送信したときの値を表示させることができる。これによりエラーが起こっても内容が消されない。oldは引数に指定した入力項目の古い値(現在の値が設定される前の値)を返す。old('name')とすればnameというフィールドの前回送信した値を出力できる。inputタグのvalue属性に設定するだけでいい。-->
<!--     <tr><th></th><input type="submit" value="send"></tr>
  </form> -->
  </table>
  {{$items->links()}}
  <!-- $itemsはsimplePaginateで取得したインスタンス。そして$itemsには、前後の移動のためのリンクを生成する機能も含まれている。 -->
@endsection

@section('footer')
copyright 2017 yamamoto
@endsection
