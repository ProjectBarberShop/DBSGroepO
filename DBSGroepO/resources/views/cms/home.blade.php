@extends('layouts.cms')

@section('content')
<div class="row">
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-info">
      <div class="inner">
         <h3></h3>
         <p>{{ __("Foto's") }}</p>
      </div>
      <div class="icon">
         <i class="ion ion-camera"></i>
      </div>
      <a href="{{url('cms/fotos')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-success">
      <div class="inner">
         <h3></h3>
         <p>{{__("Pagina's")}}</p>
      </div>
      <div class="icon">
         <i class="ion ion-compose"></i>
      </div>
      <a href="{{url('cms/paginas')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-warning">
      <div class="inner">
         <h3></h3>
         <p>{{__("Contact")}}</p>
      </div>
      <div class="icon">
         <i class="ion ion-person-add"></i>
      </div>
      <a href="{{url('cms/contact')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-danger">
      <div class="inner">
         <h3></h3>
         <p>{{__("Video's")}}</p>
      </div>
      <div class="icon">
         <i class="ion ion-ios-videocam"></i>
      </div>
      <a href="{{url('cms/videos')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-secondary">
      <div class="inner">
         <h3></h3>
         <p>{{__("Contactpersonen")}}</p>
      </div>
      <div class="icon">
         <i class="ion ion-person"></i>
      </div>
      <a href="{{url('cms/contactpersonen')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>

<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-secondary">
        <div class="inner">
            <h3></h3>
            <p>{{__("Footer")}}</p>
        </div>
        <div class="icon">
            <i class="ion ion-compose"></i>
        </div>
        <a href="{{url('cms/footer')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-secondary">
        <div class="inner">
            <h3></h3>
            <p>{{__("Navigatiebar")}}</p>
        </div>
        <div class="icon">
            <i class="ion ion-compose"></i>
        </div>
        <a href="{{url('cms/navbar')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
