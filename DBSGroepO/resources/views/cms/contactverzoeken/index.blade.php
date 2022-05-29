@extends('layouts.cms')

@section('content')

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contactverzoeken</h3>
                <button type="button" onclick="sortTable()" class="btn btn-primary ml-2">Sorteer datum</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_id" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Titel</th>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Telefoonnummer</th>
                            <th>Bericht</th>
                            <th>Verwijderen</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contactRequestdata as $c)
                        <tr>
                            <td>{{$c->created_at}}</td>
                            <td>{{$c->title}}</td>
                            <td>{{$c->firstname}} {{$c->preposition}} {{$c->lastname}}</td>
                            <td><a href="mailto:{{$c->email}}">{{$c->email}}</a></td>
                            <td><a href="tel:{{$c->phonenumber}}">{{$c->phonenumber}}</a></td>
                            <td class="p-0 w-25"><textarea rows="5" cols="60" class="resize-disable" readonly>{{$c->message}}</textarea></td>
                            <td>
                                <form action="{{ route('contactverzoeken.destroy', $c->id) }}" method="POST" id="{{$c->id}}">
                                    <input type="hidden" name="{{$c->firstname}} {{$c->preposition}} {{$c->lastname}}">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <button type="submit" class="btn btn-primary" onclick="confirmSubmit({{$c->id}})">Verwijderen</button>
                            </td>
                            </div>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Datum</th>
                            <th>Titel</th>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Telefoonnummer</th>
                            <th>Bericht</th>
                            <th>Verwijderen</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                {{ $contactRequestdata->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    let ascending = false;

function confirmSubmit(formId) {
    let newFormId = document.getElementById(formId);
    if(confirm("Weet u zeker dat u het contactverzoek van " + newFormId.querySelector("input").name + " wilt verwijderen?")) {
        newFormId.submit();
    }
}

function sortTable() {
    ascending = !ascending;
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("table_id");
    switching = true;

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[0];
            y = rows[i + 1].getElementsByTagName("TD")[0];
            console.log(x);
            if(y != undefined){
                if(ascending){
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                else{
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }

        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}
</script>
