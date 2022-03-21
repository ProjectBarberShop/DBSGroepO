@extends('layouts.cms')

@section('content')

<div class="row justify-content-center">
    @foreach($videos as $v)
    <div class="col-md-5 d-flex align-items-center">
        <div class="card card-primary">
              <div class="card-header">
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
@endsection
