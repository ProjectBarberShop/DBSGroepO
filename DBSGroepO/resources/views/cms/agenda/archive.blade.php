@extends('layouts.cms')
@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if($agendapunten->isEmpty())
    <a class="btn btn-secondary" href="{{route('agenda.index')}}">Terug</a>
    <p>Er zijn geen gearchiveerde agendapunten</p>
    @else
    <div class="row mb-2">
        <div class="col-md-1">
            <a class="btn btn-secondary" href="{{route('agenda.index')}}">Terug</a>
        </div>
        <div class="col-md-2">
            <form style="width:auto" action="{{route('agenda.deleteallarchived')}}", method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger px-3" onclick="return confirm('Weet je zeker dat je alle gearchiveerde agendapunten wilt verwijderen? Deze actie kan niet ongedaan worden');">Alles verwijderen</button>
            </form>
        </div>
    </div>
    @endif
    @foreach($agendapunten as $agendapunt)
    <div class="card" dusk="agenda">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    @foreach($agendapunt->Category as $categorie)
                    {{$categorie->title}}
                    @endforeach
                </div>
                <div class="col-md-1 offset-md-1">
                    <form action="{{route('agenda.deletearchived', $agendapunt->id)}}", method="POST">
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