<html>
<head>
  <title>Hello/index</title>
  <style>
  body{
    font-size:16pt;
    color:#999;
  }
  h1{
    font-size:100pt;
    text-align:right;
    color:#eee;
    margin:-40px 0px -50px 0px;
  }
  </style>
</head>
<body>
  <h1>Blade/Index</h1>
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
</html>
