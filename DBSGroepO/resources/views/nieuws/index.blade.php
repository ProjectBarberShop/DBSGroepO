@extends('layouts.app')

@section('content')
<div class="d-flex">
@foreach ($newsletterdata as $n)
@if($loop->first)
@continue
@endif
<div class="card w-50 m-2">
    <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($n->image->photo)) }}" style="height: 250px; object-fit: cover;">
    <div class="card-header bg-danger text-yellow">
        <h4 class="card-title">{{$n->title}}</h4>
        <p class="d-inline mt-2">{{$n->created_at}}</p>
    </div>
    <div class="card-body bg-secondary text-white">
        {{$n->message}}
    </div>
</div>
@endforeach
</div>
@endsection
