@extends('layouts.cms')

@section('content')
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<section>
    <div class="container-fluid">
        <div class="row">
           <div class="col-lg-12 margin-tb">
                 <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('youtube.create') }}"> Nieuwe pagina maken</a>
                 </div>
           </div>
        </div>
        <div class="row">
            @foreach($webpageTitles as $v)
                <div class="col-md-4 d-flex ">
                    <div class="card card-primary">
                        <div class="card-header">
                            <p>{{$v->slug}}</p>
                        </div>
                        <div class="card-body">
                            @component('components.youtube')
                                @slot('youtube_key')
                                    {{$v->youtube_video_key}}
                                @endslot
                            @endcomponent
                        </div>
                        <div class="d-flex flex-row justify-content-end mt-4">
                            <a href="{{ route('youtube.edit', $v->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
                            <form action="{{ route('youtube.destroy', $v->id) }}" method="POST">
                                <input type="hidden" name="{{$v->youtube_video_key}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary">Verwijderen</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</section>
@endsection
