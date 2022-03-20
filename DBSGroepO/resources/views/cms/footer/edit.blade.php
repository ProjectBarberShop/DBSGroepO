@extends('layouts.cms')

@section('content')
    <form action="{{route ('footer.update' , $footerdata->id)}}" method="POST" class="d-flex flex-column">
        @method('PUT')
        @csrf
        <label for="address">Adres:</label>
        <input type="text" name="address" value="{{$footerdata->address}}">
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{$footerdata->email}}">
        <label for="phonenumber">Telefoonnummer:</label>
        <input type="text" name="phonenumber" value="{{$footerdata->phonenumber}}">
        <label for="secretaryemail">Secretaris email:</label>
        <input type="email" name="secretaryemail" value="{{$footerdata->secretaryemail}}">
        <label for="kvk">Kvk nummer:</label>
        <input type="number" name="kvk" value="{{$footerdata->kvk}}">
        <label for="facebookurl">Facebook url:</label>
        <input type="text" name="facebookurl" value="{{ $footerdata->facebookurl }}">
        <button type="submit" class="btn btn-primary float-right mt-4">Bijwerken</button>
    </form>
@endsection
