@extends('layouts.cms')

@section('content')
<div class="row">
@foreach($contactsdata as $c)
<div class="card card-primary m-2 col-md-3 p-0">
    <div class="card-header">
        <h3 class="card-title w-100">{{$c->firstname}} {{$c->preposition}} {{$c->lastname}}</h3>
    </div>
    <div class="p-2">
        {{$c->email}} <br>
        {{$c->phonenumber}} <br>
        @if($c->is_published)
        Gepubliceerd op de website
        @else
        Niet gepubliceerd op de website
        @endif<br>
    </div>
    <div class="card-body d-flex justify-content-end align-items-end p-2">
        <form id="{{str_replace(' ', '', $c->firstname).$c->id}}" action="{{ route('contactpersonen.destroy', $c->id) }}" method="POST">
            <input type="hidden" name="{{$c->firstname}} {{$c->preposition}} {{$c->lastname}}">
            @method('DELETE')
            @csrf
        </form>
        <div>
            <a href="{{ route('contactpersonen.edit', $c->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
        </div>
        <div>
            <button type="submit" class="btn btn-primary" onclick="confirmSubmit({{$c}})">Verwijderen</button>
        </div>
    </div>
</div>

@endforeach
</div>
<div class="row">
  <div class="col-md-3">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Voeg contactpersoon toe</h3>
      </div>
      <div class="card-body">
      <form action="{{ route('contactpersonen.store') }}" method="POST" class="d-flex flex-column">
        @csrf
        <label for="firstname">Voornaam:</label>
        <input type="text" name="firstname" placeholder="Voornaam">
        <label for="preposition">Tussenvoegsel:</label>
        <input type="text" name="preposition" placeholder="Tussenvoegsel">
        <label for="lastname">Achternaam:</label>
        <input type="text" name="lastname" placeholder="Achternaam">
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Email">
        <label for="phone">Telefoonnummer:</label>
        <input type="tel" name="phonenumber" placeholder="Telefoonnummer">
        <label for="ispublished">Publiceren:</label>
        <input type="checkbox" name="ispublished" placeholder="Publiceren">
        <button type="submit" class="btn btn-primary float-right mt-4">Contactpersoon toevoegen</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
<script>
  function confirmSubmit(item) {
      event.preventDefault();
      let itemName = item.firstname.replace(/\s/g,'');
      let formId = itemName + item.id;
      if(confirm("Weet u zeker dat u " + document.querySelector("#" + formId + " input").name + " wilt verwijderen?")) {
          document.querySelector("#" + formId).submit();
      }
  }
</script>
