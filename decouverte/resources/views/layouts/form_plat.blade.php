@extends('layouts/base')

@section('body')

    <h1 class="text-center">Formulaire d'ajout de nouveau plat</h1>

    <form action="{{ isset($plat->id) === false ? route('plat.store') : route('plat.store.update', ['id' => $plat->id]) }}" class="col-6" method="POST">

{{-- Changement la méthode en PATCH si nous sommes en modification d'un Plat --}}
        @isset($plat->id)
            {{ method_field('PATCH') }}
        @endisset

        <input value="{{ old('title', $plat->title) }}" type="text" name="title" class="form-control" placeholder="Titre du plat">

        <textarea name="content" cols="30" rows="10" placeholder="Contenu du plat">{{ old('content', $plat->content) }}</textarea>

{{--    Pour la sécurité et la protéction des failles CSRF    --}}
        @csrf
{{--  On ajoute un token grâce à la directive blade @csrf  --}}

        @if (isset($plat->id))
            <button type="submit" class="btn btn-success">Modifier</button>
        @else
            <button type="submit" class="btn btn-success">Ajouter</button>
        @else
            <button type="submit" class="btn btn-success">Supprimer</button>
        @endif

    </form>

@endsection
