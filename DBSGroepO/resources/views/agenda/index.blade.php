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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="date"></p>
        <p id="description"></p>
        <p id="location"></p>
        <a target="_blank" id="location_URL"></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
   $(document).ready(function () {

   var SITEURL = "{{ url('http://127.0.0.1:8000') }}";
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
                        eventClick: function(calEvent, jsEvent, view) {
                           var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                           var start = String(calEvent.start);
                           var end = String(calEvent.end);

                           var startDate = new Date(start).toLocaleString();
                           var endDate = new Date(end).toLocaleString();

                           document.getElementById("exampleModalLabel").innerHTML = calEvent.title;
                           document.getElementById("date").innerHTML = startDate + " - " + endDate;
                           document.getElementById("description").innerHTML = calEvent.description;
                           if(calEvent.location != null) {
                              document.getElementById("location").innerHTML = calEvent.location;
                           } else {
                              document.getElementById("location").innerHTML = "Geen locatie opgegeven"
                           }
                           if(calEvent.locationURL != null) {
                              document.getElementById("location_URL").innerHTML = "Locatie";
                              document.getElementById("location_URL").href = calEvent.locationURL;
                           }
                           myModal.show();
                        },
                        height: 500,
                        editable: false,
                        displayEventTime: true,
                        eventRender: function (event, element, view) {
                           if (event.allDay === 'true') {
                                    event.allDay = true;
                           } else {
                                    event.allDay = false;
                           }
                        },
                        selectable: true,
                        selectHelper: true,
                     });

   });
   function refreshCalendar() {
      $('#calendar').fullCalendar("refetchEvents");
   }

</script>


@endsection
