@extends('layouts.cms')

@section('content')
<div class="row">
    @foreach($ticketdata as $t)
        @foreach($agenda as $a)
            @if($t->agenda_id === $a->id)
                @if($t->amount_of_tickets > 0)
                    <div class="card card-primary m-2 col-md-3 p-0">
                        <div class="card-header">
                            <h3 class="card-title w-100 mb-2">{{$a->title}}</h3>
                            <p>{{$a->start}} / {{$a->end}}</p>
                            <p>Aantal tickets: {{$t->amount_of_tickets}}</p>
                            <p class="fs-6 m-0">
                                @if($t->is_published)
                                    Gepubliceerd op de website
                                @else
                                    Niet gepubliceerd op de website
                                @endif
                            </p>
                        </div>
                        <p class="p-2">{{$a->description}}</p>
                        <div class="card-body d-flex justify-content-end align-items-end p-2">
                            <a href="{{ route('tickets.edit', $t->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
                            <form action="{{route('tickets.destroy', $t->id)}}", method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Verwijderen</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    @endforeach
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Maak nieuwe ticket aan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tickets.store') }}" method="POST" class="d-flex flex-column" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <label for="title">Titel:</label>
                    <select name="agenda">
                        @foreach ($agenda as $a)
                            @if(!$a->amount_of_tickets > 0)
                                <option value="{{$a->id}}">{{$a->title}} / {{$a->start}} / {{$a->end}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="amount">Aantal tickets:</label>
                    <input type="number" name="amount" placeholder="Aantal tickets">
                    <label for="price">Prijs:</label>
                    <input type="text" name="price" placeholder="Prijs">
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
