@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            {{-- <p>{!!$pagecontent->main_text!!}</p> --}}
            @foreach ($webpage as $w)
                <p>{!!$w->main_text!!}</p>
            @endforeach
            @foreach ($pagecontent as $collomcontext)
                @foreach($collomcontext->ColomContext as $p)
                    @if($collomcontext->ColomContext->count() > 1)
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
             @endforeach
                {{-- @if($youtube_key != null)
                    @component('components.youtube')
                            @slot('youtube_key')
                                {{$youtube_key}}
                            @endslot
                    @endcomponent
                @endif --}}
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
</div>

@endsection
