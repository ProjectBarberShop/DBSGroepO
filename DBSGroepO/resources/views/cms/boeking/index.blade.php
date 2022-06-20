@extends('layouts.cms')

@section('content')
<div class="row">
    @foreach($agendadata as $a)
        @if($a->amount_of_tickets > 0 )
            <div class="card card-primary m-2 col-md-3 p-0">
                <div class="card-header">
                    <h3 class="card-title w-100 mb-2">{{$a->title}}</h3>
                    <p>{{$a->start}} / {{$a->end}}</p>
                    <p>Aantal tickets besteld: {{$a->amount_of_tickets}}</p>
                    <p class="fs-6 m-0">
                        @if($a->is_published)
                            Gepubliceerd op de website
                        @else
                            Niet gepubliceerd op de website
                        @endif
                    </p>
                </div>
                <p class="p-2">{{$a->description}}</p>
                <div class="card-body d-flex justify-content-end align-items-end p-2">
                    <form action="{{ route('ticket.destroy', $a->id) }}" method="POST" id="{{$a->id}}a">
                        <input type="hidden" name="{{$a->title}}">
                        @method('PUT')
                        @csrf
                    </form>
                    <div>
                        <a href="{{ route('ticket.edit', $a->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="confirmSubmit({{$a->id}}, 'a')" id="remove">Verwijderen</button>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Maak nieuwe ticket aan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('ticket.update') }}" method="POST" class="d-flex flex-column" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <label for="title">Titel:</label>
                    <select name="agenda">
                        <option value="0" selected>-- Tickets --</option>
                        @foreach ($agendadata as $a)
                            @if(!$a->amount_of_tickets > 0)
                                <option value="{{$a->id}}">{{$a->title}} / {{$a->start}} / {{$a->end}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="amount">Aantal tickets:</label>
                    <input type="number" name="amount" placeholder="Aantal tickets">
                    <label for="ispublished">Publiceren:</label>
                    <input type="checkbox" name="ispublished" placeholder="Publiceren">
                    <input type="submit" class="btn btn-primary float-right mt-4" value="Ticket aanmaken" id="addTicket">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
function confirmSubmit(formId, uniqueId) {
    let newFormId = document.getElementById(formId + uniqueId);
    if(confirm("Weet u zeker dat u " + newFormId.querySelector("input").name + " wilt verwijderen?")) {
        newFormId.submit();
    }
}
</script>
