@extends('layouts.cms')

@section('content')
<div class="container">

<form action="{{route ('learntosing-beheer.store')}}" method="POST" class="d-flex flex-column">
    @csrf
    <label for="title">Titel:</label>
    <input type="text" name="title" value="{{ old('title') }}">
    @error('title')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <label for="description">Beschrijving:</label>
    <textarea id="description" name="description">{{ old('description') }}</textarea>
    <p id="count" class="h5 m-0">Tekens over: 255</p>
    @error('description')
    <p class="text-danger">{{ $message }}</p>
    @enderror

    <div class="d-flex flex-column">
        <label for="image">Foto:</label>
        @foreach($imagesdata as $img)
            @if(old('imageId') == $img->id)
                <img src="data:image/jpg;base64,{{ chunk_split(base64_encode($img->photo)) }}" class="img-fluid">
            @endif
        @endforeach
        <div class="imagePosition"></div>
    </div>
    <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modal-info">Selecteer foto</button>
    <div id="image-data">
        @include('components\images')
    </div>
    <input type="hidden" name="image_id" id="selectedImage_id">
    @error('image_id')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <label for="category_id">Categorie</label>
    <select name="category_id">

        @foreach($categories as $category)
        <option {{ old('title') == $category->id ? ' selected' : ''}} value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
    </select>
    <a href='/cms/learntosing/categorie'>Categorie aanmaken</a>
    @error('category_id')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <label for="date">Datum en tijd:</label>
    <input type="datetime-local" name="date" id="date" value="{{ old('date') }}">
    <label for="location">Locatie:</label>
    <input type="text" name="location" value="{{ old('location') }}">
    <label for="mentor">Begeleider:</label>
    <input type="text" name="mentor" value="{{ old('mentor') }}" >
    <label for="price">prijs:</label>
    <input type="number" step="0.01" name="price" value= {{ old('price') }}>
    <button type="submit" class="btn btn-primary float-right mt-4" id='create'>Aanmaken</button>
</form>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    $(document).on('hidden.bs.modal','#modal-info', function (e) {
        $("body").css("overflow", "auto");
    })

    function fetch_data(page)
    {
        $.ajax({
            url:"/cms/fotos/fetch_data?page="+page,
            success:function(data)
            {
                $('#image-data').html(data);
                var myModal = new bootstrap.Modal(document.getElementById('modal-info'));
                myModal.show();
                $('.modal-backdrop').first().remove();
            }
        });
    }

});
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
        newImage.className += " img w-50 h-50";
        imageClasses[i].append(newImage);
    }

    let imageInputField = document.getElementById("selectedImage_id");
    imageInputField.setAttribute('value', imageId);
}

</script>