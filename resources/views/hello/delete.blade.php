@extends('layouts.helloapp')

@section('title', 'Delete')
@section('menubar')
  @parent
  削除ページ
@endsection

@section('content')
  <table>
    <form action="/delete" method="post" accept-charset="utf-8">
      {{csrf_field()}}
      <input type="hidden" name="id" value="{{$form->id}}">
      <tr><th>name: </th><td><input type="text" name="name" value="{{$form->name}}"></td></tr>
      <tr><th>mail: </th><td><input type="text" name="mail" value="{{$form->mail}}"></td></tr>
      <tr><th>age: </th><td><input type="text" name="age" value="{{$form->age}}"></td></tr>
      <tr><th></th><input type="submit" value="send"></tr>
    </form>
  </table>
  <!-- valueに$formの値を設定しておけばその値が表示される。 -->
@endsection


@section('footer')
copyright 2017 yamamoto
@endsection
