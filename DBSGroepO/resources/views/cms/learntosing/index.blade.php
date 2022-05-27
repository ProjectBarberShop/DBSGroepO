@extends('layouts.cms')

@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible"
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show" >
       <strong>{{ $message }}</strong>
    </div>
@endif

<a href="{{ route('learntosing.create') }}" class="h3 link-primary" >Aanmaken</a>

<div class="row mt-3">
    @foreach($courses as $course)
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header bg-white">
                    <h3 class="card-title"><strong>Titel: {{$course->title}}</strong></h3><br>
                    <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($images[$loop->index]->photo)) }}" class="img-fluid w-50 h-50">
                </div>
                <div class="card-body">
                    <p class="mb-1">Beschrijving: {{$course->description}}</p> <br>
                    <p class="mb-1">Categorie: {{$course->category->title}}</p> <br> 
                    <p class="mb-1">Datum: {{$course->date}}</p> <br> 
                    <p class="mb-1">Locatie: {{$course->location}}</p> <br> 
                    <p class="mb-1">Begeleider: {{$course->mentor}}</p> <br> 
                    <p class="mb-1">Prijs: {{$course->price}}</p> <br> 
                    <div class="d-flex flex-row justify-content-end mt-4">
                        <a href="{{ route('learntosing.edit', $course->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
                        <form id="{{str_replace(' ', '', $course->title).$course->id}}"  action="{{ route('learntosing.destroy', $course->id) }}" method="POST">
                            <input type="hidden" name="title" value="{{$course->title}}">
                            @method('DELETE')
                            @csrf
                        </form>
                        <button type="submit" class="btn btn-danger" id="remove" onclick="confirmSubmit({{$course}})">Verwijderen</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
</div>
@endsection

<script>
    function confirmSubmit(item) {
        event.preventDefault();
        let itemName = item.title.replace(/\s/g,'');
        let formId = itemName + item.id;
        if(confirm("Weet u zeker dat u " + document.querySelector("#" + formId + " input").value + " wilt verwijderen?")) {
            document.querySelector("#" + formId).submit();
        }
    }
</script>