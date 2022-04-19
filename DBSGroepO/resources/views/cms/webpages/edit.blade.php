@extends('layouts.cms')

@section('content')

<section class="content">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pagina hoofdtekst</h3>
            </div>
            @foreach($pagecontent as $page)
                        <form action="{{route ('paginas.update' , $page->id)}}" method="post">
                        @csrf
                        @method('PUT')
                            <div class="card-body">
                                <textarea name="body" id="{{$page-> id}}">{{$page -> main_text}}</textarea>
                                <label for="title">Url link</label>
                                <input  class="mt-4" name="title" value="{{$page -> slug}}"/>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
            @endforeach
            <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('paginas.index') }}"> Back</a>
            </div>
        </div>
    </div>
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
