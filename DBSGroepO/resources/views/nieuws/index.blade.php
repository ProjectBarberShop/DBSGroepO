@extends('layouts.app')

@section('content')
@if(empty($newsletterdata->count()))
    <h2 class="p-4">Er is nog geen nieuws beschikbaar</h2>
@else
    <div class="container">
        <div class="row">
            @foreach ($newsletterdata as $n)
                <div class="col-md-4">
                    <div class="card m-2">
                        <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($n->image->photo)) }}" style="height: 250px; object-fit: cover;">
                        <div class="card-header bg-danger text-black">
                            <h4 class="card-title">{{$n->title}}</h4>
                            <p class="d-inline mt-2">{{$n->created_at}}</p>
                        </div>
                        <div class="card-body bg-secondary text-white">
                            <p class="fs-4 m-0">{{Str::limit($n->message, 20)}}</p>
                            <a class="text-primary cursor-pointer fs-4" onclick="modalShow()" alt="lees meer">Lees meer</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $newsletterdata->links() }}
    </div>
@endif
@endsection
