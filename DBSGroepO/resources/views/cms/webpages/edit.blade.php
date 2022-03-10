@extends('layouts.cms')

@section('content')

<section class="content">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pagina's met context</h3>
            </div>
            <form action="{{route ('paginas.update' , $page->id)}}" method="post">
            @csrf
            @method('PUT')
                <div class="card-body">
                    <textarea name="body" id="{{$page-> id}}" value="{{$page -> body}}">{{$page -> body}}</textarea>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
            <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('paginas.index') }}"> Back</a>
            </div> 
        </div>
    </div>
</section>


<script>
      tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
});
</script>
@endsection