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
            <div id="image-data">
                    @include('components\images')
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){

        $(document).on('click', '#modal-info .pagination a', function(event){
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
