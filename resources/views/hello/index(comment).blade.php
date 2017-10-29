@extends('layouts.helloapp')
<!-- レイアウトの継承設定 -->
@section('title','Index')
<!-- レイアウトで様々な区画を定義するために用いられるのが@section -->
@section('menubar')
  @parent
<!-- @parentは親レイアウトのsectionを指す。親の@sectionに子の@sectionを指定する場合、親の@section部分を子の@sectionを指定する場合、親の@section部分をこのsectionが上書きする。 -->
  インデックスページ
@endsection

@section('content')
  <p>ここが本文のコンテンツです</p>
  <p>必要なだけ記述できます</p>
  <!-- コンポーネントは一つのテンプレートとして独立して用意されるレイアウト用の部品 -->
<!--   @component('components.message')
    @slot('msg_title')
    Caution!
    @endslot -->
    <!-- @slotの内容がコンポーネントの$msg_title,$msg_contentにはめ込まれて表示される -->
<!--     @slot('msg_content')
    これはメッセージの表示です。
    @endslot
  @endcomponent -->
  @include('components.message',['msg_title'=>'OK','msg_content'=>'サブビューです。'])
  <!-- @include(テンプレート名,[key,valueの指定]) -->
  <!-- スロットはサブビューでは使えない。ただし、コントローラーからテンプレートに渡された変数はそのままサブビューのテンプレート内でも使うことができる。 またサブビューを読み込む際に変数を渡せる-->
  <!-- 今回はmessage.blade.phpに変数を渡している？ -->
@endsection

@section('footer')
copyright 2017 yamamoto
@endsection

<!-- <html>

<body>
  <h1></h1>
  @if ($message != '')
  <p>こんにちは,{{$message}}</p>
  @else
  <p>何か書いて下さい</p>
  @endif
  <form action="/" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="text" name="msg">
    <input type="submit">
  </form>
  <ul>
  @php
  $counter = 0;
  @endphp
  @while($counter<count($data))
  <li>{{$data[$counter]}}</li>
  @php
  $counter++
  @endphp
  @endwhile
  </ul>
</body>
</html> -->
