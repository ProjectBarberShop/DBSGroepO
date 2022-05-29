@extends('layouts.cms')

@section('content')
<div class="container">

<form action="{{ route('learntosing-beheer.update', $course->id) }}" method="POST" class="d-flex flex-column">
    @csrf
    @method('PUT')
    <label for="title">Titel:</label>
    <input type="text" name="title" value="{{ $course->title }}">
    @error('title')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <label for="description">Beschrijving:</label>
    <textarea id="description" name="description">{{ $course->description }}</textarea>
    <p id="count" class="h5 m-0">Tekens over: 255</p>
    @error('description')
    <p class="text-danger">{{ $message }}</p>
    @enderror

    <div class="d-flex flex-column">
        <label for="image">Foto:</label>
        @foreach($imagesdata as $img)
            @if($course->image_id == $img->id)
                <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="img-fluid w-25 h-25">
            @endif
        @endforeach
                <label for="image">Nieuwe foto:</label>
                <div class="imagePosition"></div>
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
    <input type="hidden" name="image_id" id="selectedImage_id" value="{{ $course->image_id }}">
    @error('image_id')
    <p class="text-danger">{{ $message }}</p>
     @enderror

    <label for="category_id">Categorie</label>
    <select name="category_id">

        @foreach($categories as $category)
        <option {{ $course->category?->id == $category->id ? ' selected' : ''}} value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
    </select>
    <a href='/cms/learntosing/categorie'>Categorie aanmaken</a>
    @error('category_id')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    <label for="date">Datum en tijd:</label>
    <input type="datetime-local" name="date" id="date" value="{{ $course->date }}">
    <label for="location">Locatie:</label>
    <input type="text" name="location" value="{{ $course->location }}">
    <label for="mentor">Begeleider:</label>
    <input type="text" name="mentor" value="{{ $course->mentor }}" >
    <label for="price">prijs:</label>
    <input type="number" step="0.01" name="price" value= {{ $course->price }}>
    <button type="submit" class="btn btn-primary float-right mt-4" id="edit">Wijzigen</button>
</form>
</div>
@endsection

<script>
    let textarea = null;

setTimeout(() => {
    textarea = document.getElementById('description');
    textarea.addEventListener('keyup', textareaLengthCheck, false);
    textarea.addEventListener('keydown', textareaLengthCheck, false);
}, 1000);

function textareaLengthCheck() {
    let textAreaLength = textarea.value.length;
    let charactersLeft = 255 - textAreaLength;
    let count = document.getElementById('count');
    if(charactersLeft < 0){
        textarea.classList.add('is-invalid');
        count.classList.add('text-danger');
    }
    else{
        textarea.classList.remove('is-invalid');
        count.classList.remove('text-danger');
    }
    count.innerHTML = "Tekens over: " + charactersLeft;
}


function modalShow() {
    event.preventDefault();
    document.getElementById("modal-info").style.display = "flex";
}

function modalClose() {
    event.preventDefault();
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
        newImage.className += " img w-25 h-25";
        imageClasses[i].append(newImage);
    }

    let imageInputField = document.getElementById("selectedImage_id");
    imageInputField.setAttribute('value', imageId);
    modalClose();
}

</script>