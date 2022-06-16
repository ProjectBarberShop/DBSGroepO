@extends('layouts.cms')
@section('content')
<section>
    <div class="container">
        <div class="row">
            @foreach($images as $img)
            <div class="col-md-6 col-sm-6">
                <div class="table-responsive">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$img->title}}</h4>
                            </div>
                            <div class="card-body">
                                <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="w-50 h-50 ">
                                <form action="{{ route('paginas.destroyImage', [$webpage->id , $img->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="ImageRemove{{$img->id}}" class="btn btn-danger">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
