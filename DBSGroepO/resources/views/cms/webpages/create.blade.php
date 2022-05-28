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
       <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('paginas.index') }}"> Back</a>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
       <label for="slug">Link pagina:</label>
       <input class="mt-4" type="text" name="slug" placeholder="url-link">
        <label for="navItem">Als dropdown onder:</label>
        <select name="navItem" required>
            <option value="0">Geen</option>
            @foreach($navItems as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
       <div class="row justify-content-center" id="multiForm">
          <div class="col-12" >
             <div class="card">
                <div class="card-header">
                   <h3 class="card-title">Hoofdtekst context</h3>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="button" name="add" id="addRemoveText" class="ion-android-add btn-primary"> nieuwe text</button>
                 </div>
                <div class="card-body" >
                   <label for="main_text">Hoofdtekst pagina:</label>
                   <textarea class="" name="main_text" placeholder="Bovenste tekst pagina"></textarea>
                   <div class="remove-me">
                   </div>
                </div>
             </div>
          </div>
        </div>
    </div>
    </form>
 </section>
<script>


var i = 0;
$("#addRemoveText").click(function () {
    ++i;
    let test = '<div class="col-6 remove-me" id="multiForm"><div class="card"><div class="card-header"><h3 class="card-title">Kolom teksten</h3></div><div class="card-body"><div class="remove-me"><input class="mb-4 w-100" name="multiInput['+i+'][colom_title_text]" placeholder="column title"><textarea class="mb-2" name="multiInput['+i+'][colomn_text]" placeholder="main text"></textarea><button type="button" class="remove-item btn btn-danger mt-4">Delete</button></div></div>'
    $("#multiForm").append(''+test+'');
        tinymce.init({
            selector: 'textarea',
            language: 'nl',
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
      language: 'nl',
      plugins: 'autolink lists media table ',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
});
</script>
@endsection
