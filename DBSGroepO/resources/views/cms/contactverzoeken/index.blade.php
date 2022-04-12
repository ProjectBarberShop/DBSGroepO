@extends('layouts.cms')

@section('content')

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contactverzoeken</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table_id" class="table table-bordered table-hover">
                    <thead>
                    <tr>
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
                        <td>{{$c->title}}</td>
                        <td>{{$c->firstname}} {{$c->preposition}} {{$c->lastname}}</td>
                        <td><a href="mailto:{{$c->email}}">{{$c->email}}</a></td>
                        <td><a href="tel:{{$c->phonenumber}}">{{$c->phonenumber}}</a></td>
                        <td>{{$c->message}}</td>
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
                        <th>Titel</th>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Telefoonnummer</th>
                        <th>Bericht</th>
                        <th>Verwijderen</th>
                    </tr>
                    </tfoot>
                </table>
                {{ $contactRequestdata->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

<script>
function confirmSubmit(formId) {
    let newFormId = document.getElementById(formId);
    if(confirm("Weet u zeker dat u het contactverzoek van " + newFormId.querySelector("input").name + " wilt verwijderen?")) {
        newFormId.submit();
    }
}
</script>
