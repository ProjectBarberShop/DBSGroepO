@extends('layouts.cms')

@section('content')
    <section class="content">
        @foreach ($pagecontent as $page)
        <div class="pull-right md-4">
            <a class="btn btn-danger" href="{{ route('paginas.index') }}"> Back</a>
            <button type="submit" form="submition-form" formaction="{{ route('editColomText.updateAndInsert', $page->id) }}" class="btn btn-primary">Update</button>
            <button type="button" name="add" id="addRemoveText" class=" btn ion-android-add btn-success"> nieuwe text</button>
        </div>
        <div class="row mt-4">
            <form id="submition-form" method="post">
                @csrf
                @method('post')
                    @foreach ($page->ColomContext as $collom)
                        <div class="col-12 justify-content-center">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Kolom teksten</h3>
                                </div>
                                <div class="card-body">
                                    <input hidden name="collomMainText[{{ $collom->id }}][id]" value="{{ $collom->id }}">
                                    <label for="collomMainText[{{ $collom->id }}][colom_title_text]">Collom titeltekst</label>
                                    <input class="md-4" name="collomMainText[{{ $collom->id }}][colom_title_text]" id="{{ $collom->id }}" value="{{ $collom->colom_title_text }}">
                                    <label for="collomMainText[{{ $collom->id }}][colomn_text]">Collom hoofdtekst</label>
                                    <textarea class="md-4" name="collomMainText[{{ $collom->id }}][colomn_text]" id="textarea{{ $collom->id }}">{{ $collom->colomn_text }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </form>
                <div class="row justify-content-center" id="multiForm">
                </div>
        </div>
        @endforeach
    </section>
    <script>
        var i = 0;
        $("#addRemoveText").click(function() {
            ++i;
            let divform =
                '<div class="col-6 remove-me" id="multiForm"><div class="card"><div class="card-header"><h3 class="card-title">Kolom teksten</h3></div><div class="card-body"><div class="remove-me"><input class="mb-4" name="multiInput[' +
                i + '][colom_title_text]" placeholder="collom title"><textarea id="columtext'+i+'" class="mb-2" name="multiInput[' + i +
                '][colomn_text]" placeholder="main text"></textarea><button type="button" id="delete'+i+'" class="remove-item btn btn-danger mt-4">Delete</button></div></div>'
            $("#multiForm").append('' + divform + '');
            tinymce.init({
                body_id: 'columtext'+i+'',
                selector: 'textarea',
                toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
                toolbar_mode: 'floating',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
            });
        });
        $(document).on('click', '.remove-item', function() {
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
