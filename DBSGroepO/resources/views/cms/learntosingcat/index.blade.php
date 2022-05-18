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
         <div class="col-12 col-sm-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Categorieen</h3>
               </div>
               <div class="card-body">
                  <table id="table_id" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>Title</th>
                           <th>Aangemaakt op</th>
                           <th>Bijwerken</th>
                           <th>Verwijderen</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($categories as $c)
                        <tr>
                            <form id="update-categorie{{$c->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                 <td>
                                     <input type="text" name="title" id="title{{$c->id}}" value="{{$c->title}}" class="form-control" required/>
                                </td>

                            </form>
                           <td>{{$c->created_at}}</td>
                           <td>
                            <button type="submit" form="update-categorie{{$c->id}}" formaction="{{ route('categorie.update', $c->id) }}" id="update{{$c->id}}" class="btn btn-success">Bijwerken</button>
                            </td>
                            <td>
                                <form action="{{ route('categorie.destroy', $c->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="delete{{$c->id}}" class="btn btn-danger">Verwijderen</button>
                                </form>
                            </td>
                          </div>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Aangemaakt op</th>
                            <th>Bijwerken</th>
                            <th>Verwijderen</th>
                         </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container-fluid">
    <div class="row">
        <div class="col-4 col-sm-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categoriee aanmaken</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('categorie.store') }}" method="POST">
                    @csrf
                    <table class="table" id="multiForm">
                        <thead>
                            <tr>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" name="title" id="addCategorie" class="form-control" required/></td>
                        </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="pull-right md-8 ">
                        <button type="submit" class="btn btn-success md-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
   </div>
</section>
@endsection
