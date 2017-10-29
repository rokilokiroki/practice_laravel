@extends('layouts.helloapp')

@section('title','Index')
@section('menubar')
  @parent

  インデックスページ
@endsection

@section('content')
  <p>ここが本文のコンテンツです</p>
  <p>必要なだけ記述できます</p>
  <p>Controller value<br>'message' = {{$message}}</p>
  <p>ViewComposer value<br>'View_message'={{$view_message}}</p>
@endsection

@section('footer')
copyright 2017 yamamoto
@endsection
