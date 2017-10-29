@extends('layouts.helloapp')

@section('title','Index')

@section('menubar')
  @parent
  インデックスページ
@endsection

@section('content')
  <p>ここが本文のコンテンツです</p>
  <p>必要なだけ記述できます</p>
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
