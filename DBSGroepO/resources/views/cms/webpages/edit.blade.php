@extends('layouts.cms')

@section('content')

<section class="content">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pagina hoofdtekst</h3>
            </div>
            <form action="{{route ('paginas.update' , $page->id)}}" method="post">
            @csrf
            @method('PUT')
                <div class="card-body">
                    <textarea name="body" id="body">{{$page -> main_text}}</textarea>
                    </br>
                    <label for="title">Link pagina:</label>
                    <input class="mt-4" type="text" name="title" value="{{$page -> slug}}">
                    <label for="navItem">Als dropdown onder:</label>
                    <select name="navItem" required>
                        <option value="0">Geen</option>
                        @foreach($navitems as $item)
                            <option value="{{$item->id}}" {{$item->id == $selected ? 'selected' : '' }}>{{$item->name}}</option>
                        @endforeach
                    </select>

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
        body_id : "body",
        selector: 'textarea',
        plugins: 'autolink lists media table ',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
});
</script>
@endsection
