@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
            @foreach($pagecontent as $w)
                {!!($w->body)!!}
            @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
