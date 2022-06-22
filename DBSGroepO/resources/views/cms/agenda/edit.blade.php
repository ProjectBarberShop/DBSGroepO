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
            <form action="{{route('agenda.update', $agendapunt->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $agendapunt->title) }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <textarea type="text" class="form-control" name="description" required>{{ old('description', $agendapunt->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="start">Start</label>
                    <input id="start" type="datetime-local" class="form-control" name="start" value="{{ old('start', $agendapunt->start) }}" required>
                </div>
                <div class="form-group">
                    <label for="end">Eind</label>
                    <input id="end" type="datetime-local" class="form-control" name="end" value="{{ old('end', $agendapunt->end) }}" required>
                </div>
                <div class="form-group">
                    <label for="category">Categorie (optioneel)</label>
                    <select name="category" class="form-select" aria-label="Categorie" value="{{ old('category, $agendapunt->category') }}">
                        <option selected></option>
                        @foreach($categories as $c)
                            <option value="{{$c->id}}">{{$c->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="location">Locatie (optioneel)</label>
                    <input type="text" class="form-control" name="location" value="{{ old('location', $agendapunt->location) }}">
                </div>
                <div class="form-group">
                    <label for="locationURL">Google Maps URL (optioneel)</label>
                    <input type="text" class="form-control" name="locationURL" value="{{ old('locationURL', $agendapunt->locationURL) }}">
                </div>
                <div class="row">
                    <a href="/cms/agenda" class="btn btn-outline-secondary col-md-1 ml-2 mr-2">Terug</a>
                    <button id="createsubmit" type="submit" class="btn btn-primary col-md-1">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>



@endsection