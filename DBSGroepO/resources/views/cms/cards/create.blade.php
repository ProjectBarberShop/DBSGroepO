@extends('layouts.cms')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="content">
    <form action="{{ route('card.store' , $pageID) }}" method="POST">
       @csrf
       <div class="pull-right">
          <a class="btn btn-primary" href="{{ route('paginas.index') }}"> Back</a>
          <button type="submit" class="btn btn-success">Submit</button>
       </div>
       <div class="row justify-content-center" id="multiForm">
          <div class="col-12" >
             <div class="card">
                <div class="card-header">
                   <h3 class="card-title">Cards aanmaken</h3>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                   <button type="button" name="add" id="addRemoveText" class="ion-android-add btn-primary"> nieuwe card</button>
                </div>
                <div class="card-body" >
                   <label for="main_text">Card title:</label>
                   <input class="" name="main_text" placeholder="Title voor de card"/>
                   <input type=file id="upload">
                   <div class="remove-me">
                    </div>
                </div>
                </div>
             </div>
          </div>
       </div>
       </div>
    </form>
 </section>
 <script>

var i = 0;
$("#addRemoveText").click(function () {
    ++i;
    let card = '<div class="row col-md-6" id="multiForm"><div class="card card-success remove-me"><div class="card-body"><div class="row"><div class="col-md-6 col-lg-6 col-xl-4"><div class="card"><div class="card mb-2 bg-gradient-dark"><img class="card-img-top" id="img-' + i + '-preview"  src="{{asset('assets/images/TempFotos/Foto5.jpg')}}"><div class="card-img-overlay d-flex flex-column justify-content-end"><h5 class="card-title text-primary text-white">(Hier komt de card title dit is een concept)</h5></div></div></div><button type="button" class="remove-item btn btn-danger mt-4">Delete</button></div></div></div></div>'
    $("#multiForm").append(''+card+'')
    });


function imgToData(input) {
    if (input.files) {
        $.each(input.files, function(i, v) {
            var n = i + 1;
            var File = new FileReader();
            File.onload = function(event) {
              $('#multiForm').append(''+card+'');


            };

            File.readAsDataURL(input.files[i]);
          });
    }
  }


  $('input[type="file"]').change(function(event) {
    imgToData(this);
  });

$(document).on('click', '.remove-item', function () {
    $(this).parents('.remove-me').remove();
});


</script>
@endsection
