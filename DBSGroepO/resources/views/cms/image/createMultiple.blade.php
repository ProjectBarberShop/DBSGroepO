@extends('layouts.cms')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="content">
    <form action="{{ route('Afbeelding.storeMultiple' , $pageID) }}" method="POST" id="Form">
        @csrf
        @method('POST')
        <div class="pull-right md-8 ">
        <a class="btn btn-primary md-4" href="{{url('cms/paginas')}}"> Back</a>
            <button type="submit" class="btn btn-success md-4">Submit</button>
            <label id="selectedImages">Geselecteerde images: </label>
        </div>
        <div class="card-columns mt-2">
            @foreach($afbeeldingen as $img)          
                <div class="card m-1" onclick="SelectImg({{$img->id}}, '{{$img->title}}')" id="image{{$img->id}}">
                    <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="card-img-top h-75" style="object-fit: scale-down;">
                    <div class="card-body" style="display: none"></div>
                    <div class="card-footer">
                        <small class="text-muted">{{$img->title}}</small> 
                    </div>
                </div>
                </a>
            @endforeach
        </div>
    </form>
</section>
<script>
    let i = 0;
    function SelectImg(id, title){
        if(i == 8){
            alert("U kunt maar 8 afbeeldingen per actie kopppelen.");
        }else{
            ++i;
            let input = document.createElement('input');
            input.value = id;
            input.id = "input"+i;
            input.name = "multiInput["+i+"][image_id]";
            input.style.display = "none";
            document.getElementById("Form").appendChild(input);

            let text = document.getElementById("selectedImages").innerText;
            if(i == 1){
                text += " "+title;
            }else{
                text += " | "+ title;
            }
            document.getElementById("selectedImages").innerText = text;
        } 
    }
</script>
@endsection
