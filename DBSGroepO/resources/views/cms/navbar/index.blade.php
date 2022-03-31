@extends('layouts.cms')

@section('content')
    <div class="row">
        @foreach($navitems as $item)
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Navigatie balk item</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-1">Naam: {{$item->name}}</p> <br>
                        <a class="mb-1" href="{{$item->link}}">Link: {{$item->link}}</a> <br>

                        <div class="d-flex flex-row justify-content-end mt-4">
                            <a href="{{ route('navbar.edit', $item->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

@endsection
