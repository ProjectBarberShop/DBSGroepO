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
    <form action="{{ route('paginas.store') }}" method="POST">
       @csrf
       <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-success">Submit</button>
       </div>
       <br>
       <div class="row justify-content-center" id="multiForm">
          <div class="col-6" >
             <div class="card">
                <div class="card-header">
                   <h3 class="card-title">Hoofdtekst context</h3>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="button" name="add" id="addRemoveText" class="ion-android-add btn-primary"> nieuwe text</button>
                 </div>
                <div class="card-body" >
                   <label for="main_text">Hoofdtekst pagina:</label>
                   <textarea name="main_text" placeholder="Bovenste tekst pagina"></textarea>
                   <br>
                   <br>
                   <label for="title">Route:</label>
                   <input type="text" name="title" placeholder="">

                   <div class="remove-me">
                   </div>
                </div>
             </div>
          </div>
            <div class="col-6" id="multiForm2" >
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Card context</h3>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="button" name="add" id="addRemoveCard" class="ion-android-add  btn-success"> nieuwe card</button>
                    </div>
                    <div class="card-body " >
                            <label for="main_text">Text voor in de card:</label>
                            <textarea name="main_text" placeholder="text in card"></textarea>
                            <br>
                            <br>
                            <label for="file">Image voor card:</label>
                            <input type="file" accept="image/*" name="image" id="file"  onchange="loadFile(event)">
                            <img id="output" style="display:block; object-fit:cover" width="100vw" height="100vh" />
                        <div class="remove-me">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('paginas.index') }}"> Back</a>
     </div>

    </form>
 </section>
<script>


var i = 0;
$("#addRemoveText").click(function () {
    ++i;
    let test = '<div class="col-6 remove-me" id="multiForm"><div class="card"><div class="card-header"><h3 class="card-title">Paginas met context</h3></div><div class="card-body"><div class="remove-me"><input name="multiInput['+i+'][colom_title_text]" placeholder="collom title"><br><br><textarea name="multiInput['+i+'][colomn_text]" placeholder="main text"></textarea><br><br><button type="button" class="remove-item btn btn-danger">Delete</button></div></div>'
    $("#multiForm").append(''+test+'');
        tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    });
$(document).on('click', '.remove-item', function () {
    $(this).parents('.remove-me').remove();
});

tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
});

var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
@endsection
