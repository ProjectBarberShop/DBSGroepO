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
      <a href="{{url('cms/paginas')}}" id="paginas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-warning">
      <div class="inner">
         <h3></h3>
         <p>{{__("Contactpersonen")}}</p>
      </div>
      <div class="icon">
         <i class="ion ion-person-add"></i>
      </div>
      <a href="{{url('cms/contactpersonen')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
      <a href="{{url('cms/youtube')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-info">
      <div class="inner">
         <h3></h3>
         <p>{{__("Agenda")}}</p>
      </div>
      <div class="icon">
         <i class="ion ion-calendar"></i>
      </div>
      <a href="{{url('cms/agenda')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-success">
      <div class="inner">
         <h3></h3>
         <p>{{__("Nieuwsbrieven")}}</p>
      </div>
      <div class="icon">
         <i class="ion ion-ios-paper"></i>
      </div>
      <a href="{{url('cms/nieuwsbrieven')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
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
    <div class="small-box bg-danger">
        <div class="inner">
            <h3></h3>
            <p>{{__("Contactverzoeken")}}</p>
        </div>
        <div class="icon">
            <i class="ion ion-at"></i>
        </div>
        <a href="{{url('cms/contactverzoeken')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3></h3>
            <p>{{__("Navigatiebar")}}</p>
        </div>
        <div class="icon">
            <i class="ion ion-ios-navigate"></i>
        </div>
        <a href="{{url('cms/navbar')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3></h3>
            <p>{{__("Categorieën learntosing")}}</p>
        </div>
        <div class="icon">
            <i class="ion ion-ios-musical-notes"></i>
        </div>
        <a href="{{url('cms/learntosing/categorie')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-warning">
      <div class="inner">
         <h3></h3>
         <p>{{__("Cursussen learntosing")}}</p>
      </div>
      <div class="icon">
         <i class="ion ion-person-add"></i>
      </div>
      <a href="{{url('cms/learntosing-beheer')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>

<div class="col-lg-3 col-6">
   <!-- small box -->
   <div class="small-box bg-danger">
      <div class="inner">
         <h3></h3>
         <p>{{__("Tickets")}}</p>
      </div>
      <div class="icon">
         <i class="ion ion-person-add"></i>
      </div>
      <a href="{{url('cms/tickets')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
   </div>
</div>
@endsection
