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
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oeps&#33;&#33;&#33;</strong> er is iets fout met je input:<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
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
                                <label class="form-label" for="title">Onderwerp:&#42;</label>
                                <input type="text" name="title" class="form-control" required></input>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="firstname">Voornaam:&#42;</label>
                                <input type="text" name="firstname" class="form-control" required></input>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="preposition">Tussenvoegsel:</label>
                                <input type="text" name="preprosition" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="surname">Achternaam:&#42;</label>
                                <input type="text" name="surname" class="form-control" required></input>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">E-mail:&#42;</label>
                                <input type="email" name="email" class="form-control" required></input>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="phonenumber">Telefoon nummer:&#42;</label>
                                <input type="number" name="phonenumber" class="form-control" pattern="^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$" required></input>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="message">Bericht:&#42;</label>
                                <textarea name="message" id="contactmsg" cols="30" rows="10" class="form-control" required></textarea>
                            </div>
                        <button type="submint" class="btn btn-primary float-right">Verzenden</button>
                    </form>
                </div>
            </div>
            <p>
                &#42; Verplicht om in te vullen
            </p>
        </div>
    </div>
</div>
@endsection
