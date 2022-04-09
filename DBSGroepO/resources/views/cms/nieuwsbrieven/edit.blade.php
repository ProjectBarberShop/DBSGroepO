@extends('layouts.cms')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary p-2">
            <label for="image">Huidige foto:</label>
            <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($newsletterdata->photo)) }}" class="img-fluid m-2">
            <div class="d-flex flex-column">
                <label for="image">Nieuwe foto:</label>
                <div class="imagePosition"></div>
            </div>
            <button type="button" class="btn btn-default" onclick="modalShow()">
            Selecteer foto
            </button>
            <div class="modal fade show" id="modal-info" aria-modal="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content bg-info">
                        <div class="modal-header">
                            <h4 class="modal-title">Selecteer foto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" onclick="modalClose()" class="fs-2">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @forelse($imagesdata as $img)
                            <a onclick="cloneimage({{$img->id}}, 'imagePosition', true, 'col-md-5'), modalClose()">
                                <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="img-fluid m-2 col-md-5" id="{{$img->id}}">
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
                <textarea name="message">{{$newsletterdata->message}}</textarea>
                <label for="ispublished">Publiceren:</label>
                <input type="checkbox" name="ispublished" {{ $newsletterdata->is_published ? 'checked' : '' }}>
                <button type="submit" class="btn btn-primary float-right mt-4">Nieuwsbrief bijwerken</button>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
  function confirmSubmit(event) {
    if(confirm("Weet u zeker dat u " + event.querySelector("input").name + " wilt verwijderen?")) {
        event.submit();
    }
  }

  function modalShow() {
    document.getElementById("modal-info").style.display = "block";
  }

  function modalClose() {
    document.getElementById("modal-info").style.display = "none";
  }

  function cloneimage(imageId, classname, overwrite, removeCurrentClass) {
    if(overwrite == true) {
      const allImages = document.querySelectorAll('.' + classname + ' > .img');
      for(i = 0; i < allImages.length; i++) {
        allImages[i].remove();
      }
    }

    const imageClasses = document.querySelectorAll('.' + classname);
    const selectedImage = document.getElementById(imageId);
    selectedImage.classList.remove(removeCurrentClass);

    let newImage = selectedImage.cloneNode(true);
    newImage.className += " img";

    for(i = 0; i < imageClasses.length; i++) {
      imageClasses[i].append(newImage);
    }

    let imageInputField = document.getElementById("imageField");
    imageInputField.setAttribute('value', imageId);
  }
</script>
