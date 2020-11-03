@extends('trees.template')

@php
    $treeChildren = $tree->children()->get();
@endphp

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center mt-5">

            <h2>Usuwanie elementu</h2>

            <form method="POST" action="{{ route('trees.destroy',["tree"=>$tree]) }}">
                @csrf
                @method('DELETE')
                <h4>Napewno usunąć?</h4>
                <p>Element: <span class="warning">{{$tree->name}}</span></p>

                @if (count($treeChildren)>0)
                <p class="warning">Ten węzeł posiada potomków</p>
                @endif
                
                <button type="submit" class="btn btn-success mb-2" >Usuń</button>
            </form>

            <a href="{{route('trees.index')}}">
            <button type="button" class="btn btn-success" >Powrót do listy</button>    
            </a>

        </div>
        <div class="col-3"></div>

    </div>
</div>