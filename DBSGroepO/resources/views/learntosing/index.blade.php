@extends('layouts.app')
@section('content')

<div class="container mt-lg-5">
    @foreach($courses as $c)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title fw-bold">{{$c->title}}</h5>
            <h5 class="card-text">{{$c->description}}</h5>
            <p class="card-text">De cursus word gegeven door: {{$c->mentor}}</p>
            <p class="card-text">Datum: {{$c->date}}</p>
        </div>
        </div>
    @endforeach
    @if($courses != null)
        {{ $courses->links() }}
    @endif
</div>

@endsection
