@extends('layouts/base')

@section('body')

    <h1 class="text-center my-3">Les plats de Cyranoo</h1>

    @if($plats->count() > 0)

        @foreach( $plats as $plat )
            <a href="{{ route('plat.show', ['id' => $plat->id] ) }}" class="text-decoration-none"><p>{{ $plat->title }}</p></a>
            <a href="{{ route('plat.update', ['id' => $plat->id]) }}" class="btn btn-info">Modifier</a>
            <a href="{{ route('plat.delete', ['id' => $plat->id]) }}" class="btn btn-info">Supprimer</a>
        @endforeach

    @else
        <p class="text-center">Aucun plat</p>
    @endif
@endsection

