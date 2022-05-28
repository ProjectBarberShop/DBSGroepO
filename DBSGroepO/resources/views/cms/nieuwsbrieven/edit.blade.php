@extends('layouts.cms')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary p-2">
            <label for="image">Huidige foto:</label>
            <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($newsletterdata->image->photo)) }}" class="img-fluid m-2">
            <div class="d-flex flex-column">
                <label for="image">Nieuwe foto:</label>
                <div class="imagePosition"></div>
            </div>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-info">Selecteer foto</button>
            <div class="modal fade" id="modal-info" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog"></div>
                <div class="modal-dialog-scrollable d-flex justify-content-center align-content-center">
                    <div class="modal-content bg-info w-75">
                        <div class="modal-header">
                            <h2 class="modal-title">Selecteer foto</h2>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row m-0 h-100">
                            @forelse($imagesdata as $img)
                                <div class="d-flex justify-content-center align-items-center col-6 col-md-4 p-0">
                                    <a onclick="cloneimage({{$img->id}}, 'a', 'imagePosition', null, null, true)" data-bs-dismiss="modal" class="m-2">
                                        <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="img-fluid" id="{{$img->id}}a">
                                    </a>
                                </div>
                            @empty
                                <p class="fs-5">Er zijn nog geen foto's beschikbaar. Ga naar: <a href="{{ route('fotos.index') }}">foto's pagina</a></p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{route ('nieuwsbrieven.update' , $newsletterdata->id)}}" method="POST" class="d-flex flex-column">
                @method('PUT')
                @csrf
                <input type="hidden" name="imageId" id="imageField" value="{{$newsletterdata->image_id}}">
                <label for="title">Titel:</label>
                <input type="text" name="title" value="{{$newsletterdata->title}}">
                <label for="message">Bericht:</label>
                <textarea name="message" rows="10">{{$newsletterdata->message}}</textarea>
                <label for="ispublished">Publiceren:</label>
                <input type="checkbox" name="ispublished" {{ $newsletterdata->is_published ? 'checked' : '' }}>
                <input type="submit" class="btn btn-primary float-right mt-4" value="Nieuwsbrief bijwerken" id="editNews">
            </form>
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
