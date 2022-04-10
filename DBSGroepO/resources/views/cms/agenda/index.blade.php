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