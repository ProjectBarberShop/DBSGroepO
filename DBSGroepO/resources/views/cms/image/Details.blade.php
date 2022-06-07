@extends('layouts.cms')

@section('content')
<div class="card responsive w-50">
<img class="card-img" src="data:image/jpg;base64,{{ chunk_split(base64_encode($image->photo)) }}" alt="{{$image->discription}}">
  <div class="card-body">
    <h4 class="card-title">Title: {{$image->title}}</h4>
    <p class="card-text">
    label: {{$image->tagName}}<br>
    <strong>Beschrijving:</strong><br>
    {{$image->discription}}<br>
    <strong>Gekoppeld aan:</strong><br>
        @foreach($image->Webpages as $page)
    	    - {{$page->slug}}<br>
        @endforeach
    </p>
  </div>
</div>
<a href="{{ route('fotos.index') }}" class="mr-2 btn btn-primary">terug</a>
@endsection
