@extends('layouts.cms')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pagina's met context</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>id</th>
                    <th>body</th>
                    <th>created_at</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($webpages as $w) 
                    <tr>
                        <td>{{$w->id}}</td>
                        <td>{{$w->body}}</td>
                        <td>{{$w->created_at}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>body</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div> 
@endsection