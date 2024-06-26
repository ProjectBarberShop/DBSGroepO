@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            @foreach ($pagecontent as $pagecontent)
                <p>{!!$pagecontent->main_text!!}</p>
                @foreach($pagecontent->ColomContext as $p)
                    @if($pagecontent->ColomContext->count() > 1)
                    <div class="col-md-6">
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
                @foreach ($pagecontent->youtube as $y)
                    @if($y != null)
                        @if($y->count() > 1)
                        <div class="col-md-6 ">
                            @component('components.youtube')
                                    @slot('youtube_key')
                                        {{$y->youtube_video_key}}
                                    @endslot
                            @endcomponent
                        </div>
                        @else
                        <div class="col-md-12">
                            @component('components.youtube')
                                @slot('youtube_key')
                                    {{$y->youtube_video_key}}
                                @endslot
                            @endcomponent
                        </div>
                        @endif
                    @endif
                @endforeach
            @endforeach
            <div class="container px-4 py-5" id="custom-cards">
                <h2 class="pb-2 border-bottom">Custom cards</h2>
                <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                    <div class="col">
                        <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg')">
                            <div class="d-flex flex-colomn h-100 p-5 pb-3 text-white text-shadow-1">
                                <h2 class="pt-5 mb-4 display-6 lh-1 fw-bold" id="card-title"> Short title long jacket </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg')">
                            <div class="d-flex flex-colomn h-100 p-5 pb-3 text-white text-shadow-1">
                                <h2 class="pt-5 mb-4 display-6 lh-1 fw-bold"> Short title long jacket </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg')">
                            <div class="d-flex flex-colomn h-100 p-5 pb-3 text-white text-shadow-1">
                                <h2 class="pt-5 mb-4 display-6 lh-1 fw-bold"> Short title long jacket </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
