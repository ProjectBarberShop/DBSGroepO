@extends('layouts.cms')

@section('content')
    <form action="{{route ('navbar.update' , $navdata->id)}}" method="POST" class="d-flex flex-column">
        @method('PUT')
        @csrf
        <label for="name">Naam:</label>
        <input type="text" name="name" value="{{$navdata->name}}">
        <label for="link">Link:</label>
        <input type="text" name="link" value="{{$navdata->link}}">
        <button type="submit" class="btn btn-primary float-right mt-4">+</button>
    </form>



    <div class="row mt-3">
        @foreach($navdata->dropdownItems as $item)
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Dropdown item</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-1">Naam: {{$item->name}}</p> <br>
                        <a class="mb-1" href="{{$item->link}}">Link: {{$item->link}}</a> <br>
                        <div class="d-flex flex-row justify-content-end mt-4">
                            <a href="{{ route('dropdown.edit', $item->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
                            <form id="{{str_replace(' ', '', $item->name).$item->id}}" action="{{ route('dropdown.destroy', $item->id) }}" method="POST">
                                <input type="hidden" name="{{$item->name}}">
                                @method('DELETE')
                                @csrf
                            </form>
                            <button type="submit" class="btn btn-danger" onclick="confirmSubmit({{$item}})">Verwijderen</button>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header bg-danger">
                        <h3 class="card-title">Voeg item toe</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dropdown.store') }}" method="POST" class="d-flex flex-column">
                            @csrf
                            <label for="name">Naam:</label>
                            <input type="text" name="name" placeholder="Naam">
                            <label for="link">Link:</label>
                            <input type="text" name="link" placeholder="Link">
                            <input type="hidden" name="navItemId" value="{{$navdata->id}}">
                            <button type="submit" class="btn btn-primary float-right mt-4">+</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection

<script>
    function confirmSubmit(item) {
        event.preventDefault();
        let itemName = item.name.replace(' ', '');
        let formId = itemName + item.id;
        if(confirm("Weet u zeker dat u " + document.querySelector("#" + formId + " input").name + " wilt verwijderen?")) {
            document.querySelector("#" + formId).submit();
        }
    }
</script>
