@foreach ($newsletterdata as $n)
@if(!empty($n))
@if($loop->first)
<div class="img-responsive d-flex align-items-center justify-content-center">
    <img src="{{url($n->imagepath)}}">
    <div class="position-absolute text-center w-100 d-flex justify-content-center">
        <div class="position-absolute bg-yellow w-100 h-100 opacity-50"></div>
        <div class="p-4 position-relative w-50">
            <h1 class="m-0">{{$n->title}}</h1>
            <p class="m-0 fs-4">
                {{$n->message}}
            </p>
        </div>
    </div>
</div>
@else
<div class="card bg-secondary mb-2">
    <img src="{{url($n->imagepath)}}">
    <div class="card-header">
        <h5 class="card-title bg-black">{{$n->title}}</h5>
    </div>
    <div class="card-body">
        {{$n->message}}
    </div>
</div>

@endif
@endif
@endforeach
