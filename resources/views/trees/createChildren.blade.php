@extends('trees.template')

@section('content')
    
<div class="container">
    <div class="row">

        <div class="col-3"></div>

        <div class="col-6 text-center">
            <h2>Utwórz węzeł</h2>

            <form method="POST" action="{{ route('trees.store') }}">
            @csrf
                <p>Rodzic: <span>{{$tree->name}}</span></p>
                <label>Nazwa elementu</label>
                <br>
                <input type="text" name="name">
                <input name="id" type="hidden" value="{{$tree->id}}">
                @include('trees.elements.error')
                <br>
                <button type="submit" class="btn btn-success mb-4 mt-4" >Gotowe</button>
            </form>

            <a href="{{route('trees.index')}}">
            <button type="button" class="btn btn-success" >Powrót do listy</button>    
            </a>

        </div>

        <div class="col-3"></div>

    </div>
</div>

@endsection