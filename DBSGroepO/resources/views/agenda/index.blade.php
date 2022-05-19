@extends('layouts.app')
@section('content')


<div class="container">
   <div class="jumbotron">
      <div class="container text-center">
         <h1>Agenda</h1>
      </div>
   </div>
   <div class="row">
      <div class="offset-md-12">
      <select onchange="refreshCalendar()" name="" id="dropdown">
         <option value="0"></option>
         @foreach($categories as $c)
            <option value="{{$c->id}}">{{$c->title}}</option>
         @endforeach
      </select>
      </div>
   </div>
   <div id='calendar'></div>
   <div class="mb-3"></div>
</div>
<script>
   $(document).ready(function () {

   var SITEURL = "{{ url('https://2122-prj78-o.azurewebsites.net') }}";
   $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
   });
   var calendar = $('#calendar').fullCalendar({
                        eventSources: [
                           {
                              url: SITEURL + "/agenda",
                              method: 'GET',
                              data: function() {
                                 return{ category: document.getElementById("dropdown").value}
                              },
                           }
                        ],
                        height: 500,
                        editable: false,
                        displayEventTime: true,
                        editable: false,
                        eventRender: function (event, element, view) {
                           if (event.allDay === 'true') {
                                    event.allDay = true;
                           } else {
                                    event.allDay = false;
                           }
                        },
                        selectable: false,
                        selectHelper: true,
                     });

   });
   function refreshCalendar() {
      $('#calendar').fullCalendar("refetchEvents");
   }

</script>


@endsection
