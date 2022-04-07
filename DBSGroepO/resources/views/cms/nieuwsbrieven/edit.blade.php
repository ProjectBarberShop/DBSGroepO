@extends('layouts.cms')

@section('content')
<form action="{{route ('nieuwsbrieven.update' , $newsletterdata->id)}}" method="POST" class="d-flex flex-column">
    @method('PUT')
    @csrf
    <label for="image">Foto:</label>
    <div class="col-md-2 m-2">
        <img src="{{$newsletterdata->imagepath}}" class="img-fluid" alt="Responsive image">
    </div>
    <input type="file" name="image" placeholder="Kies foto" accept="image/png, image/gif, image/jpeg">
    <label for="title">Titel:</label>
    <input type="text" name="title" value="{{$newsletterdata->title}}">
    <label for="message">Bericht:</label>
    <textarea name="message">{{$newsletterdata->message}}</textarea>
    <label for="ispublished">Publiceren:</label>
    <input type="checkbox" name="ispublished" {{ $newsletterdata->is_published ? 'checked' : '' }}>
    <button type="submit" class="btn btn-primary float-right mt-4">+</button>
</form>
@endsection
