
{{-- la Directive Blade '@extends' à plusieurs syntaxes :
   => 'layout/base'
   => 'layout.base'
--}}
@extends('layouts/base')

{{-- Directive Blade '@section' qui renseigne la section dans laquelle on veut "injecter" ce bout de code --}}
@section('body')

    <h1>Les plats de Cyranoo</h1>

    {{--    <p>{{ $plat1 }}</p>--}}
    {{--    <p>{{ $plat2 }}</p>--}}

    {{--  On va boucler sur notre array avec un foreach --}}
    @foreach( $plats as $plat )
        <p>{{ $plat }}</p>
    @endforeach

@endsection
