@extends('layouts.cms')

@section('content')
    <section class="content">
        @foreach ($pagecontent as $page)
            @foreach ($page->ColomContext as $collom)
                <form action="{{ route('editColomText.update', $collom->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pagina hoofdtekst</h3>
                            </div>
                            <div class="card-body">
                                <label for="colom_title_text">Collom titel tekst</label>
                                <textarea class="md-4" name="colom_title_text"
                                    id="{{ $collom->id }}">{{ $collom->colom_title_text }}</textarea>
                                <label for="colomn_text">Collom hoofdtekst</label>
                                <textarea class="md-4" name="colomn_text" id="{{ $collom->id }}">{{ $collom->colomn_text }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('paginas.index') }}"> Back</a>
                    </div>
                </form>
            @endforeach
        @endforeach
    </section>
    <script>
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
