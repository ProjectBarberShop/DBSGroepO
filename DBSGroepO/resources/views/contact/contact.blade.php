@extends('layouts.app')

@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    <script>
        $("document").ready(function(){
            setTimeout(function(){
            $("div.alert").remove();
            }, 4000 );
        });
    </script>
@endif
<div class="container">
        <div class="row">
            <h1 class="contact-header">Contact formulier</h1>
            <p class="form-intro">
            Als u een vraag of verzoek heeft, kunt u dit formulier invullen om een verzoek te doen.
            </p>
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <h3 class="card-header">
                        Mijn vraag of verzoek
                    </h3>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="title">Onderwerp:</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control"></input>
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="firstname">Voornaam:</label>
                                <input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control"></input>
                                @error('firstname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="preposition">Tussenvoegsel:</label>
                                <input type="text" name="preposition" value="{{ old('preposition') }}" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="lastname">Achternaam:</label>
                                <input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control"></input>
                                @error('lastname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">E-mail:</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"></input>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="phonenumber">Telefoon nummer:</label>
                                <input type="number" name="phonenumber" value="{{ old('phonenumber') }}" class="form-control" pattern="^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$"></input>
                                @error('phonenumber')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="message">Bericht:</label>
                                <textarea name="message" id="contactmsg" rows="10" class="form-control">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        <button type="submit" class="btn btn-primary float-right">Verzenden</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
