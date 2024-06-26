@extends('layouts.cms')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@elseif($message = Session::Get('warning'))
<div class="alert alert-warning">
    <p>{{ $message }}</p>
</div>
@endif
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('paginas.create') }}"> Nieuwe pagina maken</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pagina's met context</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="table_id" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Hoofdtekst</th>
                                    <th>Pagina title</th>
                                    <th>Toegevoegd op</th>
                                    <th>Youtube video toevoegen</th>
                                    <th>Afbeeldingen toevoegen</th>
                                    <th>Template</th>
                                    <th>Images</th>
                                    <th>Bijwerken</th>
                                    <th>Kopieren</th>
                                    <th>Verwijderen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($webpages as $w)
                                <tr>
                                    <td>{{strip_tags($w->main_text)}}</td>
                                    <td>{{$w->slug}}</td>
                                    <td>{{$w->created_at}}</td>
                                    <td><a class="btn btn-primary" href="{{ route('youtube.createMultiple' , $w->id) }}"> Youtube video toevoegen</a></td>
                                    <td><a class="btn btn-primary" href="{{ route('Afbeelding.createMultiple' , $w->id) }}"> Afbeeldingen toevoegen</a></td>
                                    <td>
                                        <div class="d-flex flex-column align-items-center">
                                            <label for="image">Huidige template:</label>
                                            @if(!empty($w->template_id))
                                            <img src="{{asset('assets/images/Templates/template').$w->template_id.'.jpg'}}" alt="template1" class="img-fluid" width="100">
                                            @endif
                                            <label for="image">Nieuwe template:</label>
                                            <div class="imagePosition{{$w->id}}"></div>

                                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-info{{$w->id}}">Selecteer template</button>
                                            <div class="modal fade" id="modal-info{{$w->id}}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog"></div>
                                                <div class="modal-dialog-scrollable d-flex justify-content-center align-content-center">
                                                    <div class="modal-content bg-info w-75">
                                                        <div class="modal-header">
                                                            <h2 class="modal-title">Selecteer template</h2>
                                                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body row m-0 h-100">
                                                            @for($t = 1; $t <= $templates; $t++)
                                                            <div class="d-flex flex-column justify-content-center align-items-center col-6 col-md-4 p-0">
                                                                <p class="fs-5">Template {{$t}}</p>
                                                                <a onclick="cloneimage('template{{$w->id}}', '{{$t}}', 'template', 'imagePosition{{$w->id}}', 100, null, true)" data-bs-dismiss="modal" class="m-2">
                                                                    <img src="{{asset('assets/images/Templates/template').$t.'.jpg'}}" alt="template{{$t}}" class="img-fluid" id="{{$t}}template">
                                                                </a>
                                                            </div>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('paginas.updateTemplate', $w->id) }}" method="POST" class="d-flex flex-column" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="imageId" id="template{{$w->id}}">
                                            <input type="submit" class="btn btn-primary float-right mt-2" value="Template bijwerken" id="changeTemplate">
                                        </form>
                                        <form action="{{ route('paginas.removeTemplate', $w->id) }}" method="post" id="{{$w->id}}a">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <button class="btn btn-primary mt-4" onclick="confirmSubmit('{{$w->id}}', 'a')" id="remove">Template verwijderen</button>
                                    </td>
                                    <td><a class="btn btn-danger" id="allImages{{$w->id}}" href="{{ route('paginas.getAllImagesWebpage',$w->id) }}">Images</a></td>
                                    <td><a class="btn btn-success" id="update{{$w->id}}" href="{{ route('paginas.edit',$w->id) }}">Bijwerken</a></td>
                                    <td>
                                        <form action="{{ route('paginas.duplicate', $w->id) }}" method="POST">
                                            @method('POST')
                                            @csrf
                                            <button type="submit" class="btn btn-success">Kopieren</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('paginas.destroy', $w->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Verwijderen</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Hoofdtekst</th>
                                    <th>Pagina title</th>
                                    <th>Toegevoegd op</th>
                                    <th>Youtube video toevoegen</th>
                                    <th>Afbeeldingen toevoegen</th>
                                    <th>Template</th>
                                    <th>Images</th>
                                    <th>Bijwerken</th>
                                    <th>Kopieren</th>
                                    <th>Verwijderen</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });

    function confirmSubmit(formId, uniqueId) {
        let newFormId = document.getElementById(formId + uniqueId);
        if (confirm("Weet u zeker dat u de template wilt verwijderen?")) {
            newFormId.submit();
        }
    }

    function cloneimage(formId, imageId, uniqueId, classname, imgWidth, imgHeight, overwrite) {
        if (overwrite == true) {
            const allImages = document.querySelectorAll('.' + classname + ' > .img');
            for (i = 0; i < allImages.length; i++) {
                allImages[i].remove();
            }
        }

        const imageClasses = document.querySelectorAll('.' + classname);
        const selectedImage = document.getElementById(imageId + uniqueId);

        for (i = 0; i < imageClasses.length; i++) {
            let newImage = selectedImage.cloneNode(true);
            newImage.setAttribute("style", "width:" + imgWidth + "px !important", "height:" + imgHeight + "px !important");
            newImage.className += " img";
            imageClasses[i].append(newImage);
        }

        let imageInputField = document.getElementById(formId);
        imageInputField.setAttribute('value', imageId);
    }
</script>
@endsection
