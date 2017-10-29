@extends('layouts.helloapp')

@section('title','Index')
@section('menubar')
  @parent

  インデックスページ
@endsection

@section('content')
  <p>ここが本文のコンテンツです</p>
  <p>必要なだけ記述できます</p>
  <table>
    @if(is_array($data))
      @foreach($data as $item)
      <tr><th>{{$item['name']}}</th></tr>
      @endforeach
    @else
      <p>該当するデータがありません</p>
    @endif
  </table>

@endsection

@section('footer')
copyright 2017 yamamoto
@endsection
