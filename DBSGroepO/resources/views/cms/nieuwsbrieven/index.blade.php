@extends('layouts.cms')

@section('content')
<div class="row">
@foreach($newsletterdata as $n)
@if(!empty($n))
<div class="col-md-3">
<div class="card card-primary">
    <img src="{{url($n->imagepath)}}">
      <div class="card-header">
        <h3 class="card-title">{{$n->title}}</h3>
      </div>
      <div class="card-body">
          {{$n->message}}<br>
          @if($n->is_published)
          Gepubliceerd op de website
          @else
          Niet gepubliceerd op de website
          @endif<br>
          <div class="d-flex flex-row justify-content-end mt-4">
            <a href="{{ route('nieuwsbrieven.edit', $n->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
            <form action="{{ route('nieuwsbrieven.destroy', $n->id) }}" method="post" id="{{$n->id}}">
                <input type="hidden" name="{{$n->title}}">
                @method('DELETE')
                @csrf
            </form>
            <button class="btn btn-primary" onclick="confirmSubmit('{{$n->id}}')">Verwijderen</button>
        </div>
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
        <h3 class="card-title">Voeg nieuwsbrief toe</h3>
      </div>
      <div class="card-body">
      <form action="{{ route('nieuwsbrieven.store') }}" method="POST" class="d-flex flex-column" enctype="multipart/form-data">
        @csrf
        <label for="image">Foto:</label>
        <input type="file" name="image" placeholder="Kies foto" accept="image/png, image/gif, image/jpeg">
        <label for="title">Titel:</label>
        <input type="text" name="title" placeholder="Titel">
        <label for="message">Bericht:</label>
        <textarea name="message" placeholder="Plaats hier uw bericht..."></textarea>
        <label for="ispublished">Publiceren:</label>
        <input type="checkbox" name="ispublished" placeholder="Publiceren">
        <button type="submit" class="btn btn-primary float-right mt-4">+</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
<script>
  function confirmSubmit(item) {
    let form = document.getElementById(item);
    if(confirm("Weet u zeker dat u " + form.querySelector("input").name + " wilt verwijderen?")) {
        form.submit();
    }
  }
</script>
