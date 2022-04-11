@extends('layouts.cms')
@section('content')

<section class="content">
    <div class="card container">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('agenda.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description') }}" required>
                </div>
                <div class="form-group">
                    <label for="start">Start</label>
                    <input type="datetime-local" class="form-control" name="start" value="{{ old('start') }}" required>
                </div>
                <div class="form-group">
                    <label for="end">Eind</label>
                    <input type="datetime-local" class="form-control" name="end" value="{{ old('end') }}" required>
                </div>
                <div class="form-group">
                    <label for="category">Categorie (optioneel)</label>
                    <select name="category" class="form-select" aria-label="Categorie" value="{{ old('category') }}">
                        <option selected></option>
                        @foreach($categories as $c)
                        <option value="{{$c->id}}">{{$c->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="location">Locatie (optioneel)</label>
                    <input type="text" class="form-control" name="location" value="{{ old('location') }}">
                </div>
                <div class="form-group">
                    <label for="locationURL">Google Maps URL (optioneel)</label>
                    <input type="text" class="form-control" name="locationURL" value="{{ old('locationURL') }}">
                </div>
                <div class="row">
                    <a href="/cms/agenda" class="btn btn-outline-secondary col-md-1 ml-2 mr-2">Terug</a>
                    <button type="submit" class="btn btn-primary col-md-1">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>



@endsection