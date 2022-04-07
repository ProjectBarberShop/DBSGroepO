<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Barbershop</title>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <!-- scripts login -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- scripts agenda -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loginscreen.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contact.css') }}" rel="stylesheet">

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v13.0" nonce="BRVg9Kka"></script>
</head>
<body class="bg-white">
<div id="app">
    {{--start header--}}
    <div class="container-fluid bg-yellow pb-3 text-center">
        <img src="{{asset('assets/images/skyline-met-naam.jpg')}}" alt="Banner" class="img-fluid w-100 h-auto h-11">
        <p class="text-center h3 slogan "><strong>Met overtuiging plezierig zingen</strong></p>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
            <a href="/" class="navbar-brand">Barbershop</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ">
                    <a href="/" class="nav-item nav-link ">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Even voorstellen</a>
                        <div class="dropdown-menu bg-danger">
                            <a href="#" class="dropdown-item-custom">Dirigent</a>
                            <a href="#" class="dropdown-item-custom">Wie zijn wij</a>
                            <a href="#" class="dropdown-item-custom">Repetoire</a>
                            <a href="#" class="dropdown-item-custom">Koorleden</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Optredens</a>
                        <div class="dropdown-menu bg-danger">
                            <a href="{{ route('optredens.index') }}" class="dropdown-item-custom">Alle optredens</a>
                            <a href="#" class="dropdown-item-custom">Album</a>
                            <a href="#" class="dropdown-item-custom">Muzieklijst</a>
                        </div>
                    </div>
                    <a href="#" class="nav-item nav-link">Introductiecursus</a>
                    <a href="#" class="nav-item nav-link">Agenda</a>
                    <a href="#" class="nav-item nav-link">Informatie</a>
                    <a href="{{ route('nieuws') }}" class="nav-item nav-link">Nieuws</a>
                </div>
                <div class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                            @auth
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a href="/cms/home" class="nav-link font-semi-bold">CMS</a>
                                    </li>
                                </ul>

                            @else
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a href="{{ route('login') }}" class=" nav-link  ">Log in</a>
                                    </li>
                                </ul>
                            @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>
    {{--end header--}}

    <main class="d-flex bd-highlight">
        <div class="w-100">
        @if(!empty($newsletterdata))
        <div class="img-responsive d-flex align-items-center justify-content-center">
            <img src="{{url($newsletterdata->imagepath)}}">
            <div class="position-absolute text-center w-100 d-flex justify-content-center">
                <div class="position-absolute bg-yellow w-100 h-100 opacity-50"></div>
                <div class="p-4 position-relative w-50">
                    <h1 class="m-0">{{$newsletterdata->title}}</h1>
                    <p class="m-0 fs-4">
                        {{$newsletterdata->message}}
                    </p>
                </div>
            </div>
        </div>
        @endif
        @yield('content')
        </div>
        <section id="sidebar" class="flex-shrink-1 bg-danger my-5 card p-3 position-sticky sticky-top h-100 mx-auto">
            <div class="h-75 card-body">
                <div id="sidebarInfoLogin">
                    <div id="sidebarFacebook" class=" bg-yellow mb-3">
                        <h4 class="text-center"><b> Facebook </b></h4>
                        <div class="fb-page w-100 " data-href="https://www.facebook.com/DuketownBarbershopSingers"
                        data-tabs="timeline"  data-height="400" data-small-header="true"
                        data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/DuketownBarbershopSingers" class="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/DuketownBarbershopSingers">Duketown Barbershop Singers</a>
                        </blockquote>
                    </div>
                </div>
                <div id="sidebarAgenda" class="rounded bg-yellow w-100">
                    <h4 class="text-center"><b> Agenda </b></h4>
                        <div class="overflow-auto p-2 mh-25" style="max-Height: 300px">
                            @foreach ($schedules as $schedule)
                                <p><b>{{ $schedule->title}}:</b> <br> begint op: {{ $schedule->start}}</p>
                                <hr>
                            @endforeach
                        </div>
                </div>
            </div>
    </section>
    </main>
    {{--start footer--}}
    <footer class="text-center text-lg-start text-white bg-danger">
        <!-- Grid container -->
        <div class="container  pb-0 ">
            <!-- Section: Links -->
            <section>
                <!--Grid row-->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">
                            Duketown Barbershop Singers
                        </h6>
                        <p>Sponsors en contactpersonen</p>
                        @foreach($contactsdata as $c)
                        @if(!empty($c))
                        <div class="card bg-secondary mb-2">
                            <div class="card-header">
                                <h5 class="card-title">{{$c->firstname}} {{$c->preposition}} {{$c->lastname}}</h5>
                            </div>
                            <div class="card-body">
                                {{$c->email}} <br>
                                {{$c->phonenumber}} <br>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <!-- Grid column -->


                    <hr class="w-100 clearfix d-md-none"/>

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 m- m flex-md-wrap">
                        <h6 class="text-uppercase mb-4 font-weight-bold ">
                            Lid worden?
                        </h6>
                        <p>
                            Mail naar:
                        </p>
                        <p class="text-white">
                            <a class="text-white"  href="mailto:secretaris@duketownbarbershopsingers.nl"> <u>{{$footerdata->secretaryemail}}</u></a>
                        </p>
                    </div>

                    <!-- Grid column -->
                    <hr class="w-100 clearfix d-md-none"/>

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 m-auto">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                        <p><i class="fas fa-home mr-3"></i> {{$footerdata->address}}</p>
                        <p><i class="fas fa-envelope mr-3"></i>
                            <a
                                class="text-white"
                                href="mailto:info@duketownbarbershopsingers.nl">
                                <u>{{$footerdata->email}}</u>
                            </a>
                        </p>
                        <p><i class="fas fa-phone mr-3"></i> {{$footerdata->phonenumber}}</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!--Grid row-->
            </section>
            <!-- Section: Links -->

            <hr class="my-3">

            <!-- Section: Copyright -->
            <section class="p-3 pt-0">
                <div class="row d-flex align-items-center">
                    <!-- Grid column -->
                    <div class="col-md-7 col-lg-4 text-center text-md-start">
                        <!-- Copyright -->
                        <div class="p-3 h5">
                            © {{now()->year}} Copyright:
                            <a class="text-white" href=" www.duketownbs.nl"
                            > www.duketownbs.nl</a
                            >
                        </div>
                        <!-- Copyright -->
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-5 col-lg-4 ml-lg-4 text-center text-md-center">
                        <div class="p3 h5">
                            Kvk: {{$footerdata->kvk}}
                        </div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-5 col-lg-2 ml-lg-1 text-center text-md-end p-0">
                        <!-- Facebook -->
                        <a
                            class="btn btn-outline-light btn-floating m-1"
                            class="text-white"
                            role="button"
                            href="{{$footerdata->facebookurl}}"
                        ><i class="fab fa-facebook-f"></i
                            ></a>

                        <!-- Twitter -->
                        <a
                            class="btn btn-outline-light btn-floating m-1"
                            class="text-white"
                            role="button"
                        ><i class="fab fa-twitter"></i
                            ></a>

                        <!-- Instagram -->
                        <a
                            class="btn btn-outline-light btn-floating m-1"
                            class="text-white"
                            role="button"
                        ><i class="fab fa-instagram"></i
                            ></a>
                    </div>
                    <!-- Grid column -->
                </div>
            </section>
            <!-- Section: Copyright -->
        </div>
        <!-- Grid container -->
    </footer>
    {{--   end footer--}}
</div>
</body>
</html>
