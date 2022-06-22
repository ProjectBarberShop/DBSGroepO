@extends('layouts.cms')

@section('content')
<h2>Titel</h2>
<p>{{$agendapunt->title}}</p>
<h2>Beschrijving</h2>
<p class="w-50">{{$agendapunt->description}}</p>
<h2>Ticket</h2>
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary p-2">
        <form action="{{route ('ticket.update' , $agendapunt->id)}}" method="POST" class="d-flex flex-column">
            @method('PUT')
            @csrf
            <input type="hidden" name="agenda" value="{{$agendapunt->id}}">
            <label for="amount">Aantal tickets:</label>
            <input type="number" name="amount" placeholder="Aantal tickets" value="{{$agendapunt->amount_of_tickets}}">
            <label for="price">Prijs:</label>
            <input type="text" name="price" placeholder="Prijs" value="{{$agendapunt->price}}">
            <label for="ispublished">Publiceren:</label>
            <input type="checkbox" name="ispublished" placeholder="Publiceren" {{ $agendapunt->is_published ? 'checked' : '' }}>
            <input type="submit" class="btn btn-primary float-right mt-4" value="Ticket aanmaken" id="editTicket">
        </form>
        </div>
    </div>
</div>
@endsection
