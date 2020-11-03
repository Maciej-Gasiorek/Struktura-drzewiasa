@extends('trees.template')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center mt-5">

            <h2>Edycja elementu</h2>

            <form method="POST" action="{{ route('trees.update',['tree'=>$tree->id]) }}">
                 @csrf
                 @method("PUT")
                <div class="inputs">
                <label>Nazwa</label>
                <br>
                <input value="{{$tree->name}}" type="text" name="name" class="mb-3">
                <br>
                <label>Rodzic</label>
                <br>
                <select name="select" id="select">
                <option {{$tree->parentID == null ? "selected" : "" }} value="root">Brak (Korzeń)</option>
                @foreach ($selectTree as $t)
                    <option {{$tree->parentID == $t->id ? "selected" : "" }} value={{$t->id}}>{{$t->name}}</option>
                @endforeach    
                </select>      
                @include('trees.elements.error')
                </div>

                <button type="submit" class="btn btn-success mt-4 mb-4" >Gotowe</button>
            </form>

            <a href="{{route('trees.index')}}">
            <button type="button" class="btn btn-success" >Powrót do listy</button>    
            </a>

        </div>
        <div class="col-3"></div>

    </div>
</div>

@endsection