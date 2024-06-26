@extends('layouts.cms')
@section('content')
<link href="{{ asset('css/agenda.css') }}" rel="stylesheet">
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
    <div class="mb-2">
        <a class="btn btn-warning" href="{{route('agenda.archived')}}" role="button">Archief</a>
    </div>
    <div class="dropdown">
        <button id="dLabel" type="button" class="btn btn-primary mb-2" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorieën beheren
        </button>
        <div class="dropdown-menu p-4" aria-labelledby="dLabel">
            <div class="pre-scrollable container">
            @foreach($categories as $c)
                <div class="row mb-1">
                    <p class="col-md-8" class="editabletext"><span class="editablecat" id="{{$c->id}}" contenteditable="true">{{$c->title}}</span></p>
                    <input type="color" value="{{$c->color}}" class="coloredits col-md-2" id="{{$c->id}}" name="coloredit">
                    <button class="btn col-md-2" onclick="return OnDeleteClick('{{$c->title}}','{{route('category.destroy', $c->id)}}', '{{$c->Agenda->count()}}')" id="catdeletebutton" type="submit"><i class="far fa-trash-alt"></i></button>
                </div>
            @endforeach
            </div>
            <form action="{{route('category.store')}}" method="POST">
            @csrf
            <label for="category">Categorie toevoegen</label>
            <div class="form-group d-flex flex-row">    
                <input type="text" class="form-control w-75" id="category" name="title">
                <input type="color" class="form-control w-25" id="color" name="color">
            </div>
            <button id="cataddbutton" type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
    <form action="agenda" method="GET">
        <div class="row mb-2">
            <div class="col-md-2">
                <a class="btn btn-success" id="createbutton" href="{{route('agenda.create')}}">Nieuw agendapunt maken</a>
            </div>
            <div class="col-md-2">
                <a class="btn btn-success" onclick="return confirm('weet je zeker dat je alle oude agendapunten wilt archiveren? Deze actie kan niet ongedaan worden.')" id="createbutton" href="{{route('agenda.archiveall')}}">Archiveer alle oude agendapunten</a>
            </div>
            <div class="col-md-3 offset-md-5">
                <div class="row">
                    <div class="col">
                        <select name="category" class="form-select" aria-label="Categorie">
                        <option selected></option>
                        @foreach($categories as $c)
                        <option value="{{$c->id}}">{{$c->title}}</option>
                        @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success col">Submit</button>
                </div>
            </div>
        </div>
    </form>
    @foreach($agendapunten as $agendapunt)
    <div class="card" dusk="agenda">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">
                    @foreach($agendapunt->Category as $categorie)
                    {{$categorie->title}}
                    @endforeach
                </div>
                <div class="col-md-1">
                    <a href="{{route('agenda.edit', ['agenda' => $agendapunt->id])}}" id="editbutton" class="btn btn-primary"><i class="far fa-edit" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-1">
                    <form action="{{route('agenda.archive', $agendapunt->id)}}", method="POST">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-warning px-3"><i class="fa fa-archive" aria-hidden="true"></i></button>
                    </form>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var editable = document.getElementsByClassName('editablecat');
        for (var i = 0 ; i < editable.length; i++) {
            $(editable[i]).on('DOMSubtreeModified',function(event){
                updateCatText(event.target);
            });
            editable[i].addEventListener("keypress", function(event) {
                if(event.key == "Enter") {
                    event.preventDefault();
                }
            });
        }

        var coloredits = document.getElementsByClassName('coloredits');
        for (var i = 0 ; i < coloredits.length; i++) {
            $(coloredits[i]).on('change',function(event){
                updateCatColor(event.target);
            });
        }
        function updateCatText(element) {
            console.log(element.id);
            $.ajax({
                url:"{{url('cms/category/updatetext/')}}",  
                method:"PUT",
                data:{
                    cat_id : element.id,
                    text: element.innerHTML
                },                              
                success: function( data ) {
                    console.log(data);
                }
            });
        }

        function updateCatColor(element) {
            $.ajax({
                url:"{{url('cms/category/updatecolor/')}}",  
                method:"PUT",  
                data:{
                    cat_id : element.id,
                    color: element.value
                },                              
                success: function( data ) {
                    console.log(data);
                }
            });
        }
    });
    function OnDeleteClick(catname,action,count) {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        document.getElementById('catform').action = action;
        document.getElementById('modaltext').innerHTML = `Weet je zeker dat je <strong>${catname}</strong> wilt verwijderen? Deze categorie wordt bij <strong>${count}</strong> agendapunten verwijderd.`;
        myModal.show();
    }
</script>
