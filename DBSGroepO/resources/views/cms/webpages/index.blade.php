@extends('layouts.cms')

@section('content')

@if ($message = Session::get('success'))
        <div class="alert alert-success">
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
                           <th>Bijwerken</th>
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
                            <td><a class="btn btn-success" id="update{{$w->id}}" href="{{ route('paginas.edit',$w->id) }}">Bijwerken</a></td>
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
</script>
@endsection
