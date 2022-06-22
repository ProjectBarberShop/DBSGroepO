@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($pagecontent as $page)
            <p>{!!$page->main_text!!}</p>
            <div class="row">
                @foreach($page->ColomContext as $p)
                    @if($page->ColomContext->count() > 1)
                    <div class="col-md-4">
                        <h2>{{$p->colom_title_text}}</h2>
                        <p>{!!$p->colomn_text!!}</p>
                    </div>
                    @else
                    <div class="col-md-12">
                        <h2>{{$p->colom_title_text}}</h2>
                        <p>{!!$p->colomn_text!!}</p>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="row">
                @foreach ($page->youtube as $y)
                    @if($y != null)
                        @if($y->count() > 1)
                        <div class="col-md-4 d-flex justify-content-center my-2">
                            @component('components.youtube')
                                    @slot('youtube_key')
                                        {{$y->youtube_video_key}}
                                    @endslot
                            @endcomponent
                        </div>
                        @else
                        <div class="col-md-12 d-flex justify-content-center my-2">
                            @component('components.youtube')
                                @slot('youtube_key')
                                    {{$y->youtube_video_key}}
                                @endslot
                            @endcomponent
                        </div>
                        @endif
                    @endif
                @endforeach
            </div>
        @endforeach
        <div class="container px-4 py-5" id="custom-cards">
            <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                @foreach($pagecontent as $page)
                    @foreach($page->Image as $i)
                        <div class="col">
                            <div class="card-block">
                                <img class="card-img-top" src="data:image/jpg;base64,{{ chunk_split(base64_encode($i->photo)) }}" style="width: 100%; height: 15vw; object-fit: scale-down;" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">{{$i->discription}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
