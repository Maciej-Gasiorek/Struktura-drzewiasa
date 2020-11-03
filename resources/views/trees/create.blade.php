@extends('trees.template')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center mt-5">

            <h2>Tworzenie Korzenia</h2>

            <form method="POST" action="{{ route('trees.store') }}">
                @csrf
                <label>Nazwa Elenentu</label>
                <br>
                <input type="text" name="name" class="mt-4 mb-4">
                @include('trees.elements.error')
                <br>
                <button type="submit" class="btn btn-success mb-4" >Dodaj</button>
            </form>

            <a href="{{route('trees.index')}}">
            <button type="button" class="btn btn-success" >Powrót do listy</button>    
            </a>

        </div>
        <div class="col-3"></div>

    </div>
</div>

@endsection