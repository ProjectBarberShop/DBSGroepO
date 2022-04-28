@extends('layouts.cms')

@section('content')
<div class="card responsive">
<img class="card-img-top" src="data:image/jpg;base64,{{ chunk_split(base64_encode($image->photo)) }}" alt="Card image cap">
  <div class="card-body">
    <h4 class="card-title">Title: {{$image->title}}</h4>
    <p class="card-text">
    label: {{$image->category}}<br>
    Gekoppeld aan:<br>
        @foreach($image->Webpages as $page)
    	    - {{$page->slug}}<br>
        @endforeach
    </p>
  </div>
</div>
<a href="{{ route('fotos.index') }}" class="mr-2 btn btn-primary">terug</a>
@endsection
