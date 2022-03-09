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
                  <table id="" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>id</th>
                           <th>body</th>
                           <th>created_at</th>
                           <th>Bijwerken</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($webpages as $w) 
                        <tr>
                           <td>{{$w->id}}</td>
                           <td>{{$w->body}}</td>
                           <td>{{$w->created_at}}</td>
                           <td><a class="btn btn-primary" href="{{ route('paginas.edit',$w->id) }}">Bijwerken</a></td>
                           
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>id</th>
                           <th>title</th>
                           <th>body</th>
                           <th>Bijwerken</th>
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


@endsection