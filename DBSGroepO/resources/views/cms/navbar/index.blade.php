@extends('layouts.cms')

@section('content')
    <div class="row">
        @foreach($navitems as $item)
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Navigatie balk item {{$item->number}}</h3>
                        <input type="number" id="pageNumber" hidden class="allign right-4" value="{{$item->number}}"/>
                        <div class="d-flex flex-row-reverse">
                                @if($item->number < count($navitems))
                                <form action="{{route('navbar.order' , $item->id)}}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <input type="hidden" name="higher" value="{{$item->number}}">
                                    <button type="submit" id="right" class="ion-android-arrow-dropright"></button>
                                </form>
                                @endif
                                @if($item->number > 1)
                                <form action="{{route('navbar.order' , $item->id)}}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <input type="hidden" name="lower" value="{{$item->number}}">
                                    <button type="submit" id="left" class="ion-android-arrow-dropleft"></button>
                                </form>
                                @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="mb-1">Naam: {{$item->name}}</p> <br>
                        <p class="mb-1">Dropdown items: {{$item->dropdownItems->count()}}</p> <br>
                        <a class="mb-1" href="{{$item->link}}">Link: {{$item->link}}</a> <br>
                        <div class="d-flex flex-row justify-content-end mt-4">
                            <a href="{{ route('navbar.edit', $item->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
                            <form id="{{str_replace(' ', '', $item->name).$item->id}}"  action="{{ route('navbar.destroy', $item->id) }}" method="POST">
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
                            <form action="{{ route('navbar.store') }}" method="POST" class="d-flex flex-column">
                                @csrf
                                <label for="name">Naam:</label>
                                <input type="text" name="name" placeholder="Naam">
                                <label for="link">Link:</label>
                                <input type="text" name="link" placeholder="Link">
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
        let itemName = item.name.replace(/\s/g,'');
        let formId = itemName + item.id;
        if(confirm("Weet u zeker dat u " + document.querySelector("#" + formId + " input").name + " wilt verwijderen?")) {
            document.querySelector("#" + formId).submit();
        }
    }
</script>
