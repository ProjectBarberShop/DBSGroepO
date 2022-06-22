@extends('layouts.app')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@elseif($message = Session::get('error'))
<div class="alert alert-error">
    <p>{{ $message }}</p>
</div>
@endif
@if(empty($agendadata->count()))
    <h2 class="p-4">Er zijn nog geen tickets beschikbaar</h2>
@else
    <div class="container">
        <div class="row">
            @foreach($ticketdata as $t)
                @foreach ($agendadata as $a)
                    @if($t->agenda_id === $a->id)
                    <div class="col-md-4">
                        <div class="card m-2">
                            <div class="card-header bg-danger text-black">
                                <h4 class="card-title">{{$a->title}}</h4>
                                <p class="mt-2">van: {{$a->start}}</p>
                                <p class="d-inline mt-2">tot: {{$a->end}}</p>
                            </div>
                            <div class="card-body bg-secondary text-white">
                                <p class="fs-4 m-0">{{Str::limit($a->description)}}</p>
                            </div>
                            <form action="{{ route('ticket.send', $t->id) }}" method="GET" id="{{$t->id}}a">
                                @csrf
                                <div>
                                    <label for="name">Naam:</label>
                                    <input type="text" name="name" placeholder="Naam">

                                </div>
                                <div>
                                    <label for="address">Adres:</label>
                                    <input type="text" name="address" placeholder="Adres">

                                </div>
                                <div>
                                    <label for="postalcode">Postcode:</label>
                                    <input type="text" name="postalcode" placeholder="Postcode">

                                </div>
                                <div>
                                    <label for="place">Woonplaats:</label>
                                    <input type="text" name="place" placeholder="Woonplaats">

                                </div>
                                <div>
                                    <label for="phonenumber">Telefoonnummer:</label>
                                    <input type="tel" name="phonenumber" placeholder="Telefoonnummer">

                                </div>
                                <div>
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" placeholder="Email">

                                </div>
                                <div>
                                    <label for="amount">Aantal tickets:</label>
                                    <select name="amount">
                                        @for($i = 0; $i < 6; $i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>

                                </div>
                                <button class="btn btn-primary" type="submit" id="sendTicket">Ticket verzenden</button>
                            </form>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endforeach
        </div>
        {{ $ticketdata->links() }}
    </div>
@endif
@endsection
