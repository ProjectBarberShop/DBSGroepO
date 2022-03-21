@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<p>

            </div>
            <div class="col-md-6">
                {{-- @if($youtube_key != null)
                    @component('components.youtube')
                            @slot('youtube_key')
                                {{$youtube_key}}
                            @endslot
                    @endcomponent
                @endif --}}
                <h2>Standard layout</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<p>

            </div>
            <div class="col-md-6">
                <h2>Standard layout</h2>

                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<p>
            </div>
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
