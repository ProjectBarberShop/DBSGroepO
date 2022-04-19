@extends('layouts.cms')

@section('content')
    <section class="content">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('paginas.index') }}"> Back</a>
        </div>
        <div class="row mt-4">
            @foreach ($pagecontent as $page)
                @foreach ($page->ColomContext as $collom)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kolom teksten</h3>
                            </div>
                            <form action="{{ route('column.destroy', [$collom->id , $page->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary">Verwijderen</button>
                            </form>
                            <form action="{{ route('editColomText.update',  $page->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <label for="colom_title_text[{{ $collom->id }}]">Collom titel tekst</label>
                                    <textarea class="md-4" name="colom_title_text[{{ $collom->id }}]"
                                        id="{{ $collom->id }}">{{ $collom->colom_title_text }}</textarea>
                                    <label for="colomn_text[{{ $collom->id }}]">Collom hoofdtekst</label>
                                    <textarea class="md-4" name="colomn_text[{{ $collom->id }}]"
                                        id="{{ $collom->id }}">{{ $collom->colomn_text }}</textarea>
                                </div>
                                <div class="remove-me">
                                </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
            <div class="row justify-content-center" id="multiForm">
                <div class="col-12" >
                    <div class="card">
                       <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                           <button type="button" name="add" id="addRemoveText" class="ion-android-add btn-primary"> nieuwe text</button>
                        </div>
                       <div class="card-body" >
                          <div class="remove-me">
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</section>
<script>
$("#addRemoveText").click(function () {
        var i = 0;
        ++i;
        let test = '<div class="col-6 remove-me" id="multiForm"><div class="card"><div class="card-header"><h3 class="card-title">Kolom teksten</h3></div><div class="card-body"><div class="remove-me"><input class="mb-4" name="multiInput['+i+'][colom_title_text]" placeholder="collom title"><textarea class="mb-2" name="multiInput['+i+'][colomn_text]" placeholder="main text"></textarea><button type="button" class="remove-item btn btn-danger mt-4">Delete</button></div></div>'
        $("#multiForm").append(''+test+'');
            tinymce.init({
                selector: 'textarea',
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
    plugins: 'autolink lists media table ',
    toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
});
</script>
@endsection
