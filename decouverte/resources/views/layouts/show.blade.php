@extends('layout/base');

@section('body')

    <h1>Plat{{$plat->title}}</h1>

    <div>contenu: </div>
    <p>{{$plat->content}}</p>

@endsection
