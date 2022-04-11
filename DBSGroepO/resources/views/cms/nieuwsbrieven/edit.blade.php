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
            <button type="button" class="btn btn-default" onclick="modalShow()">Selecteer foto</button>
            <div class="modal fade show" id="modal-info" aria-modal="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content bg-info">
                        <div class="modal-header">
                            <h4 class="modal-title">Selecteer foto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" onclick="modalClose()" class="fs-2">×</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            @forelse($imagesdata as $img)
                                <a onclick="cloneimage({{$img->id}}, 'imagePosition', true), modalClose()" class="col-4">
                                    <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="img-fluid" id="{{$img->id}}">
                                </a>
                                @empty
                                <p>Er zijn nog geen foto's beschikbaar. Ga naar: <a href="#">image page</a></p>
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
                <button type="submit" class="btn btn-primary float-right mt-4">Nieuwsbrief bijwerken</button>
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

function modalShow() {
    document.getElementById("modal-info").style.display = "block";
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
