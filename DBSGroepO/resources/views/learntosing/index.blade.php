@extends('layouts.app')
@section('content')

<div class="container mt-lg-5">
    <form action="learntosing" method="GET" class="form-inline mb-3">
        @csrf
        <input class="form-control col-sm-2 mr-sm-2" name="coursesearch" type="search" placeholder="Zoeken..." aria-label="Zoeken">
        <select name="category" class="form-select col-md-1 mr-sm-2" aria-label="Categorie">
            <option selected></option>
            @foreach($coursecategories as $c)
            <option value="{{$c->id}}">{{$c->title}}</option>
            @endforeach
        </select>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Zoek</button>
    </form>
    @foreach($courses->chunk(3) as $row)
        <div class="card-deck">
        @foreach($row as $c)
            <div class="card mb-3" style="max-width: 25em;">
                <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($c->image->photo)) }}" class="card-img-top img-thumbnail img-fluid" alt="{{$c->discription}}">
                <div class="card-body">
                    <h3 class="card-title">{{$c->title}}</h3>
                    <p class="card-text">{{$c->description}}</p>
                    <p class="card-text"><small class="text-muted">Datum: {{$c->date}}</small></p>
                    <p class="card-text"><small class="text-muted">Mentor: {{$c->mentor}}</small></p>
                    <p class="card-text"><small class="text-muted">Prijs: {{$c->price}}</small></p>
                </div>
            </div>
        @endforeach
        </div>
    @endforeach
    @if($courses != null)
        {{ $courses->links() }}
    @endif
</div>

@endsection
