@extends('layouts.app')

@section('content')
<div class="d-flex">
@if(empty($newsletterdata->count()))
    <h2 class="p-4">Er is nog geen nieuws beschikbaar</h2>
@else
@foreach ($newsletterdata as $n)
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
@endif
</div>
@endsection
