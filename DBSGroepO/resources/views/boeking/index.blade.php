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
                            <p class="d-inline mt-2">{{$a->start}}</p>
                            <p class="d-inline mt-2">{{$a->end}}</p>
                        </div>
                        <div class="card-body bg-secondary text-white">
                            <p class="fs-4 m-0">{{Str::limit($a->description)}}</p>
                        </div>
                        <form action="{{ route('ticket.sent', $a->id) }}" method="POST" id="{{$a->id}}a">
                            @csrf
                            <label for="email">email:</label>
                            <input type="email" name="email" placeholder="Email">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select>
                                @for($i = 0; $i < 6; $i++)
                                    <option>{{$i}}</option>
                                @endfor
                            </select>
                            <button class="btn btn-primary" onclick="confirmSubmit({{$a->id}}, 'a')" id="sentTicket">Ticket verzenden</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $agendadata->links() }}
    </div>
@endif
@endsection
