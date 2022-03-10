@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html>
   <head>
      <title>Laravel 9 FullCalendar Tutorial</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
   </head>
   <body>
      <div class="container">
         <div class="jumbotron">
            <div class="container text-center">
               <h1>Agenda</h1>
            </div>
         </div>
         <div id='calendar'></div>
      </div>
      <script>
         $(document).ready(function () {
            
         var SITEURL = "{{ url('/') }}";
           
         $.ajaxSetup({
             headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
           
         var calendar = $('#calendar').fullCalendar({
                             height: 500,
                             editable: false,
                             events: SITEURL + "/agenda",
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
           
      </script>
   </body>
</html>

@endsection