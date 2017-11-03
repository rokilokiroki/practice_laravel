@extends('layouts.helloapp')

@section('title', 'Show')
@section('menubar')
  @parent

  詳細ページ
@endsection

@section('content')
  @if($items != null)
    @foreach($items as $item)
    <table width="400px">
    <tr>
      <th witdh="50px">id:</th>
        <td width="50px">{{$item->id}}</td>
        <th width="50px">name:</th>
        <td width="50px">{{$item->name}}</td>
    </tr>
    </table>
    @endforeach
  @endif
  <!-- valueに$formの値を設定しておけばその値が表示される。 -->
@endsection


@section('footer')
copyright 2017 yamamoto
@endsection
