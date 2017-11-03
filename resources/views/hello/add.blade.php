@extends('layouts.helloapp')

@section('title', 'Add')
@section('menubar')
  @parent

  新規作成ページ
@endsection

@section('content')
  <table>
    <form action="/add" method="post" accept-charset="utf-8">
      {{csrf_field()}}
      <tr><th>name: </th><td><input type="text" name="name"></td></tr>
      <tr><th>mail: </th><td><input type="text" name="mail"></td></tr>
      <tr><th>age: </th><td><input type="text" name="age"></td></tr>
      <tr><th></th><input type="submit" value="send"></tr>
    </form>
  </table>
@endsection


@section('footer')
copyright 2017 yamamoto
@endsection
