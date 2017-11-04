@extends('layouts.helloapp')

@section('title','Person.index')
@section('menubar')
  @parent

  インデックスページ
@endsection

@section('content')
  <table>
  <tr><th>Data</th><th>Board</th></tr>
  @foreach ($items as $item)
    <tr>
      <td>{{$item->getData()}}</td>
      <td>
        <table width="100%">
          @foreach($item->boards as $obj)
            <tr><td>{{$obj->getData()}}</td></tr>
          @endforeach
        </table>
      </td>
      <!-- Personモデルにboardというメソッドを追加した。メソッドなので$item->board()となるところだが、リレーションの設定を行った場合、このように$this->boardというプロパティとして扱えるようになる。このboardプロバティには関連付けられたBoardモデルのインスタンスが入っていて、そこから必要な情報を取り出せして利用できる。 -->
    </tr>
  @endforeach
  </table>
@endsection

@section('footer')
copyright 2017 yamamoto
@endsection
