<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short Link Page</title>
</head>
<body>
@if(Session::has('error'))
   
    <p>{{ Session::get('error')}}</p>
    {{session()->forget('error');}}

@endif

<a href="{{route('getData', ['id' => $link->id])}}">{{$link->short_url}}</a>


</body>
</html>