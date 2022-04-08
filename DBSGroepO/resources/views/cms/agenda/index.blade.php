@extends('layouts.cms')
@section('content')

<div class="container">
    <form action="agenda" method="GET">
        <div class="row">
            <div class="mb-3 col-md-3">
                <a class="btn btn-success" href="{{route('agenda.create')}}"> Nieuw agendapunt maken</a>
            </div>
            <div class="offset-md-5 col-md-3">
                <select name="category" class="form-select" aria-label="Categorie">
                <option selected></option>
                @foreach($categories as $c)
                <option value="{{$c->id}}">{{$c->title}}</option>
                @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success mb-3 col-md-1">Submit</button>
        </div>
    </form>
    @foreach($agendapunten as $agendapunt)

    <div class="card">
    <div class="card-header">
        @foreach($agendapunt->Category as $categorie)
        {{$categorie->title}}
        @endforeach
    </div>
    <div class="card-body">
        <h5 class="card-title bold">{{$agendapunt->title}}</h5>
        <p class="card-text">{{$agendapunt->description}}</p>
        <a href="#" class="btn btn-primary">Bewerken</a>
    </div>
    </div>
    @endforeach
</div>
@endsection