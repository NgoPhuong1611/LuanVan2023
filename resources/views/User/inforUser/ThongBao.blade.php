
@extends('User.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web luyện thi toeic</title>
</head>
<body>
    <h1>mail gửi từ: {{$name}}</h1>
    <h4>với nội dung: {{$body}}</h4>
    <h4>{{$token_random}}</h4>
</body>
</html>
