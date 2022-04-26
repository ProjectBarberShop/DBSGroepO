@extends('layouts.cms')
@section('content')

<div class="container">
    <div class="dropdown">
        <button id="dLabel" type="button" class="btn btn-primary mb-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorieën beheren
        </button>
        <div class="dropdown-menu p-4" aria-labelledby="dLabel">
            <div class="pre-scrollable container">
            @foreach($categories as $c)
                <div class="row mb-1">
                    <p class="col-md-6">{{$c->title}}</p>
                    <form class="col-md-2 offset-md-3 p-1" action="{{route('category.destroy', $c->id)}}", method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn" type="submit"><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            @endforeach
            </div>
            <form action="{{route('category.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category">Categorie toevoegen</label>
                <input type="text" class="form-control" id="category" name="title">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
    <form action="agenda" method="GET">
        <div class="row">
            <div class="mb-3 col-md-3">
                <a class="btn btn-success" id="createbutton" href="{{route('agenda.create')}}">Nieuw agendapunt maken</a>
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
        <div class="row">
            <div class="col-md-2">
                @foreach($agendapunt->Category as $categorie)
                {{$categorie->title}}
                @endforeach
            </div>
            <div class="col-md-1 offset-md-8">
                <a href="{{route('agenda.edit', ['agenda' => $agendapunt->id])}}" class="btn btn-primary"><i class="far fa-edit" aria-hidden="true"></i></a>
            </div>
            <div class="col-md-1">
                <form action="{{route('agenda.destroy', $agendapunt->id)}}", method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger px-3"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title fw-bold">{{$agendapunt->title}}</h5>
        <p class="card-text">{{$agendapunt->description}}</p>
        <p class="card-text">Van {{$agendapunt->start}} tot {{$agendapunt->end}}</p>
        @if(!is_null($agendapunt->location))
        <p class="card-text">Op de locatie: {{$agendapunt->location}}</p>
        @else
        <p class="card-text">Geen locatie opgegeven</p>
        @endif
    </div>
    </div>
    @endforeach
    @if($agendapunten != null)
        {{ $agendapunten->links() }}
    @endif

</div>
@endsection