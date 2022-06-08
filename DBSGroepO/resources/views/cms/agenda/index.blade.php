@extends('layouts.cms')
@section('content')

<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Categorie verwijderen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p id="modaltext"></p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <form id="catform" action="" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-secondary">Delete</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="dropdown">
        <button id="dLabel" type="button" class="btn btn-primary mb-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorieën beheren
        </button>
        <div class="dropdown-menu p-4" aria-labelledby="dLabel">
            <div class="pre-scrollable container">
            @foreach($categories as $c)
                <div class="row mb-1">
                    <p id="cattitle" class="col-md-6">{{$c->title}}</p>
                    <button class="btn col-md-6" onclick="return OnDeleteClick('{{$c->title}}','{{route('category.destroy', $c->id)}}', '{{$c->Agenda->count()}}')" id="catdeletebutton" type="submit"><i class="far fa-trash-alt"></i></button>
                </div>
            @endforeach
            </div>
            <form action="{{route('category.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category">Categorie toevoegen</label>
                <input type="text" class="form-control" id="category" name="title">
            </div>
            <button id="cataddbutton" type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
    <form action="agenda" method="GET">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <a class="btn btn-success" id="createbutton" href="{{route('agenda.create')}}">Nieuw agendapunt maken</a>
            </div>
            <div class="d-flex flex-column flex-md-row">
                <div class="mr-md-2">
                    <select name="category" class="form-select" aria-label="Categorie">
                    <option selected></option>
                    @foreach($categories as $c)
                    <option value="{{$c->id}}">{{$c->title}}</option>
                    @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
    @foreach($agendapunten as $agendapunt)
    <div class="card" dusk="agenda">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    @foreach($agendapunt->Category as $categorie)
                    {{$categorie->title}}
                    @endforeach
                </div>
                <div class="col-md-1">
                    <a href="{{route('agenda.edit', ['agenda' => $agendapunt->id])}}" id="editbutton" class="btn btn-primary"><i class="far fa-edit" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-1">
                    <form action="{{route('agenda.destroy', $agendapunt->id)}}", method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger px-3"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title fw-bold">{{$agendapunt->title}}</h5>
            <p class="card-text">{{$agendapunt->description}}</p>
            <p class="card-text">Van {{$agendapunt->start}} tot {{$agendapunt->end}}</p>
            @if(!is_null($agendapunt->location))
            <p class="card-text">Op de locatie: {{$agendapunt->location}}</p>
            @else
            <p class="card-text">Geen locatie opgegeven</p>
            @endif
        </div>
    </div>
    @endforeach
    @if($agendapunten != null)
        {{ $agendapunten->links() }}
    @endif
</div>
@endsection

<script>
    function OnDeleteClick(catname,action,count) {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        document.getElementById('catform').action = action;
        document.getElementById('modaltext').innerHTML = `Weet je zeker dat je <strong>${catname}</strong> wilt verwijderen? Deze categorie wordt bij <strong>${count}</strong> agendapunten verwijderd.`;
        myModal.show();
    }
</script>
