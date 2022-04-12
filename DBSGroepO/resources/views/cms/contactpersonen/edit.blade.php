@extends('layouts.cms')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary p-2">
            <form action="{{route ('contactpersonen.update' , $contactdata->id)}}" method="POST" class="d-flex flex-column">
                @method('PUT')
                @csrf
                <label for="firstname">Voornaam:</label>
                <input type="text" name="firstname" value="{{$contactdata->firstname}}">
                <label for="preposition">Tussenvoegsel:</label>
                <input type="text" name="preposition" value="{{$contactdata->preposition}}">
                <label for="lastname">Achternaam:</label>
                <input type="text" name="lastname" value="{{$contactdata->lastname}}">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{$contactdata->email}}">
                <label for="phone">Telefoonnummer:</label>
                <input type="tel" name="phonenumber" value="{{$contactdata->phonenumber}}">
                <label for="ispublished">Publiceren:</label>
                <input type="checkbox" name="ispublished" {{ $contactdata->is_published ? 'checked' : '' }}>
                <button type="submit" class="btn btn-primary float-right mt-4">Contactpersoon bijwerken</button>
            </form>
        </div>
    </div>
</div>
@endsection
