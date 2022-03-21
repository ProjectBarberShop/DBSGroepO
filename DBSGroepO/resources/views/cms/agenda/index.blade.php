@extends('layouts.cms')
@section('content')

<div class="container">
    <div class="mb-3 col-md-3">
        <a class="btn btn-success" href="#"> Nieuw agendapunt maken</a>
    </div>
    @foreach($agendapunten as $a)

    <div class="card">
    <div class="card-header">
        {{$a->title}}
    </div>
    <div class="card-body">
        <h5 class="card-title bold">{{$a->title}}</h5>
        <p class="card-text">{{$a->description}}</p>
        <a href="#" class="btn btn-primary">Bewerken</a>
    </div>
    </div>

    @endforeach
</div>
@endsection