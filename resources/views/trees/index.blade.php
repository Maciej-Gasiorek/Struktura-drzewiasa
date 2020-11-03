@extends('trees.template')

@php
    const ALL_ASC = 0;
    const ALL_DESC = 1;
    const ROOTS_ASC = 2;
    const ROOTS_DESC = 3;
    const CHILDREN_ASC = 4;
    const CHILDREN_DESC = 5;

    $sortOptions = [
        ALL_ASC=>'Wszystkie elementy rosnąco',
        ALL_DESC=>'Wszystkie elementy majejąco',
        ROOTS_ASC=>'Według korzeni rosnąco',
        ROOTS_DESC=>'Według korzeni malejąco',
        CHILDREN_ASC=>'Potomkowie rosnąco',
        CHILDREN_DESC=>'Potomkowie malejąco'
    ];

    $sortOption = Request::get('sort');

    switch ($sortOption) {
        case ALL_ASC:
            $trees = $trees->sortBy('name');
            break;
        case ALL_DESC:
            $trees = $trees->sortByDesc('name');
            break;
        case ROOTS_ASC:
            $trees = $trees->whereNull('parentID')->sortBy('name');
            break;
        case ROOTS_DESC:
            $trees = $trees->whereNull('parentID')->sortByDesc('name');
            break;
    }

@endphp


@section('content')


<div class="container">

    <div class="row text-center mt-5 mb-5">
        <div class="col-4"></div>
        <div class="col-4">

        <a href={{route('trees.create')}}>
        <button type="button" class="btn btn-warning">Dodaj Korzeń</button>
        </a>
        
        </div>
        <div class="col-4"></div>
    </div>

    <div class="row">
        <div class="col-9">

        @foreach ($trees as $tree) 
            @if($tree->parentID == null)
                @include('trees.elements.showTrees',['tree'=> $tree])
            @endif
        @endforeach

        </div>
        <div class="col-3">

        <div class="sortOptions" onclick="toggleSortOptions(event)">
            <button class="sortByButton">Sortuj według</button>
            <div id="sortOptions">
                @foreach ($sortOptions as $key => $option)
                    <button 
                        onclick="window.location='{{route('trees.index',['trees'=>$trees,'sort'=>$key])}}'">
                        {{$option}}
                    </button>   
                @endforeach
            </div>
        </div>

        </div>
    </div>

    <div class="row">

    @if (session()->has('status'))
            <div class="message">
                <p class="text-center">{{session()->get('status')}}</p>
            </div>
    @endif

    </div>
</div>


@endsection