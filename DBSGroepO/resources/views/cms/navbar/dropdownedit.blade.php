@extends('layouts.cms')

@section('content')
    <form action="{{route ('dropdown.update' , $dropdowndata->id)}}" method="POST" class="d-flex flex-column">
        @method('PUT')
        @csrf
        <label for="name">Naam:</label>
        <input type="text" name="name" value="{{$dropdowndata->name}}">
        <label for="link">Link:</label>
        <input type="text" name="link" value="{{$dropdowndata->link}}">
        <input type="hidden" name="navbarItemId" value="{{$dropdowndata->navbar_item_id}}">
        <button type="submit" class="btn btn-primary float-right mt-4">Bijwerken</button>
    </form>
@endsection
