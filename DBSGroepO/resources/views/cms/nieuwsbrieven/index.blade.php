@extends('layouts.cms')

@section('content')
<div class="row">
    @foreach($newsletterdata as $n)
        <div class="card card-primary m-2 col-md-3 p-0">
            <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($n->image->photo)) }}" style="height: 250px; object-fit: cover;">
            <div class="card-header">
            <h3 class="card-title w-100 mb-2">{{$n->title}}</h3>
            <p class="d-inline">{{$n->created_at}}</p>
            </div>
            <div class="p-2">
                {{$n->message}}<br>
                @if($n->is_published)
                    Gepubliceerd op de website
                @else
                    Niet gepubliceerd op de website
                @endif<br>
            </div>
            <div class="card-body d-flex justify-content-end align-items-end p-2">
                <form action="{{ route('nieuwsbrieven.destroy', $n->id) }}" method="post" id="{{$n->id}}a">
                    <input type="hidden" name="{{$n->title}}">
                    @method('DELETE')
                    @csrf
                </form>
                <div>
                    <a href="{{ route('nieuwsbrieven.edit', $n->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
                </div>
                <div>
                    <button class="btn btn-primary" onclick="confirmSubmit({{$n->id}}, 'a')" id="remove">Verwijderen</button>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Voeg nieuwsbrief toe</h3>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column">
                    <label for="image">Foto:</label>
                    @foreach($imagesdata as $img)
                        @if(old('imageId') == $img->id)
                            <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="img-fluid">
                        @endif
                    @endforeach
                    <div class="imagePosition p-2"></div>
                </div>
                <button class="btn btn-secondary" onclick="modalShow()">Selecteer foto</button>
                <div class="modal justify-content-center align-items-center" id="modal-info" aria-modal="true" role="dialog">
                    <div class="modal-content bg-info w-75">
                        <div class="modal-header">
                            <h2 class="modal-title">Selecteer foto</h2>
                            <button class="close fs-2" onclick="modalClose()">×</button>
                        </div>
                        <div class="row m-0 pr-2 overflow-auto" style="height: 80vh;">
                            @forelse($imagesdata as $img)
                                <div class="d-flex justify-content-center align-items-center col-4 p-0">
                                    <a onclick="cloneimage({{$img->id}}, 'b', 'imagePosition', null, null, true), modalClose()" class="ml-2 mt-2">
                                        <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="img-fluid" id="{{$img->id}}b">
                                    </a>
                                </div>
                            @empty
                                <p class="fs-5">Er zijn nog geen foto's beschikbaar. Ga naar: <a href="{{ route('fotos.index') }}">foto's pagina</a></p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <form action="{{ route('nieuwsbrieven.store') }}" method="POST" class="d-flex flex-column" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="imageId" id="imageField" value="{{ old('imageId') }}">
                    @error('imageId')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="title">Titel:</label>
                    <input type="text" name="title" placeholder="Titel" value="{{ old('title') }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="message">Bericht:</label>
                    <textarea name="message" placeholder="Plaats hier uw bericht..." rows="10">{{ old('message') }}</textarea>
                    @error('message')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="ispublished">Publiceren:</label>
                    <input type="checkbox" name="ispublished" placeholder="Publiceren">
                    <input type="submit" class="btn btn-primary float-right mt-4" value="Nieuwsbrief toevoegen" id="addNews">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
function confirmSubmit(formId, uniqueId) {
    let newFormId = document.getElementById(formId + uniqueId);
    if(confirm("Weet u zeker dat u " + newFormId.querySelector("input").name + " wilt verwijderen?")) {
        newFormId.submit();
    }
}

function modalShow() {
    document.getElementById("modal-info").style.display = "flex";
}

function modalClose() {
    document.getElementById("modal-info").style.display = "none";
}

function cloneimage(imageId, uniqueId, classname, imgWidth, imgHeight, overwrite) {
    if(overwrite == true) {
        const allImages = document.querySelectorAll('.' + classname + ' > .img');
        for(i = 0; i < allImages.length; i++) {
            allImages[i].remove();
        }
    }

    const imageClasses = document.querySelectorAll('.' + classname);
    const selectedImage = document.getElementById(imageId + uniqueId);

    for(i = 0; i < imageClasses.length; i++) {
        let newImage = selectedImage.cloneNode(true);
        newImage.setAttribute("style", "width:" + imgWidth + "px !important", "height:" + imgHeight + "px !important");
        newImage.className += " img";
        imageClasses[i].append(newImage);
    }

    let imageInputField = document.getElementById("imageField");
    imageInputField.setAttribute('value', imageId);
}
</script>
