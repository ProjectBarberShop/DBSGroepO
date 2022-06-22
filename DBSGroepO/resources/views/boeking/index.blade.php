@extends('layouts.app')

@section('content')
@if(empty($agendadata->count()))
    <h2 class="p-4">Er zijn nog geen tickets beschikbaar</h2>
@else
    <div class="container">
        <div class="row">
            @foreach ($agendadata as $a)
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
                        <form action="{{ route('ticket.send', $a->id) }}" method="GET" id="{{$a->id}}a">
                            @csrf
                            <div>
                                <label for="name">Naam:</label>
                                <input type="text" name="name" placeholder="Naam" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="address">Adres:</label>
                                <input type="text" name="address" placeholder="Adres" value="{{ old('address') }}">
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="postalcode">Postcode:</label>
                                <input type="text" name="postalcode" placeholder="Postcode" value="{{ old('postalcode') }}">
                                @error('postalcode')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="place">Woonplaats:</label>
                                <input type="text" name="place" placeholder="Woonplaats" value="{{ old('place') }}">
                                @error('place')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="phonenumber">Telefoonnummer:</label>
                                <input type="tel" name="phonenumber" placeholder="Telefoonnummer" value="{{ old('phonenumber') }}">
                                @error('phonenumber')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="email">Email:</label>
                                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="amount">Aantal tickets:</label>
                                <select name="amount">
                                    @for($i = 0; $i < 6; $i++)
                                        <option {{ old('amount') == $i ? 'selected' : '' }}>{{$i}}</option>
                                    @endfor
                                </select>
                                @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-primary" onclick="confirmSubmit({{$a->id}}, 'a')" id="sendTicket">Ticket verzenden</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $agendadata->links() }}
    </div>
@endif
@endsection
