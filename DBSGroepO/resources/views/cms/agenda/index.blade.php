@extends('layouts.cms')
@section('content')

<div class="container">
    <div class="mb-2 col-md-3">
        <a class="btn btn-success" href="{{ route('paginas.create') }}"> Nieuw agendapunt maken</a>
    </div>
    @foreach($agendapunten as $a)

    <div class="card">
    <div class="card-header">
        Agendapunt
    </div>
    <div class="card-body">
        <h5 class="card-title">{{$a->title}}</h5>
        <p class="card-text">{{$a->description}}</p>
        <a href="#" class="btn btn-primary">Bewerken</a>
    </div>
    </div>

    @endforeach
</div>
@endsection