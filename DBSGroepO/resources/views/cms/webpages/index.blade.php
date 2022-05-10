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
               <div class="card-body">
                  <table id="table_id" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>Hoofdtekst</th>
                           <th>Pagina title</th>
                           <th>Toegevoegd op</th>
                           <th>Card toevoegen</th>
                           <th>Youtube video toevoegen</th>
                           <th>Afbeeldingen toevoegen</th>
                           <th>Template</th>
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
                            <td><a class="btn btn-primary" href="{{ route('card.create' , $w->id) }}"> Nieuwe cards maken</a></td>
                            <td><a class="btn btn-primary" href="{{ route('youtube.createMultiple' , $w->id) }}"> Youtube video toevoegen</a></td>
                            <td><a class="btn btn-primary" href="{{ route('Afbeelding.createMultiple' , $w->id) }}"> Afbeeldingen toevoegen</a></td>
                            <td>
                                <img src="{{asset('assets/images/Templates/template').$w->template_id.'.jpg'}}" alt="template1" class="img-fluid" width="100">
                                <div class="imagePosition p-2"></div>

                                <button type="button" class="btn btn-default" onclick="modalShow()">Selecteer foto</button>
                                <div class="modal fade show" id="modal-info" aria-modal="true" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-info">
                                            <div class="modal-header">
                                                <h2 class="modal-title">Selecteer foto</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" onclick="modalClose()" class="fs-2">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body row">
                                                @for($t = 1; $t <= $templates; $t++)
                                                    <a onclick="cloneimage({{$t}}, 'a', 'imagePosition', null, null, true), modalClose()" class="col-4 mt-4">
                                                        <img src="{{asset('assets/images/Templates/template').$t.'.jpg'}}" class="img-fluid" id="{{$t}}a">
                                                    </a>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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
                          </div>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>Hoofdtekst</th>
                           <th>Pagina title</th>
                           <th>Toegevoegd op</th>
                           <th>Card toevoegen</th>
                           <th>Youtube video toevoegen</th>
                           <th>Bijwerken</th>
                           <th>Kopieren</th>
                           <th>Verwijderen</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
               <!-- /.card-body -->
            </div>
         </div>
      </div>
   </div>
</section>

<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
    } );

    function modalShow() {
        document.getElementById("modal-info").style.display = "block";
    }

    function modalClose() {
        document.getElementById("modal-info").style.display = "none";
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
@endsection
