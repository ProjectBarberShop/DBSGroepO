<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loginscreen.css') }}" rel="stylesheet">
    {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}

</head>
<body class="bg-white">
<div id="app">
    {{--start header--}}
    <div class="container-fluid bg-yellow pb-3 text-center">
        <img src="{{asset('assets/images/skyline-met-naam.jpg')}}" alt="AdminLTE Logo" class="img-fluid w-100"
             style="height: 11rem;">
        <p class="text-center h3 "><strong>Met overtuiging plezierig zingen</strong></p>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger ">

        <a class="navbar-brand " href="/">Barbershop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto nav-fill w-75">
                <li class="nav-item">
                    <a class="nav-link "  href="/">Home </a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" style="color: yellow" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Even voorstellen
                    </a>
                    <div class="dropdown-menu bg-danger" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item-custom "  href="#">Dirigent</a>
                        <a class="dropdown-item-custom"  href="#">Wie zijn wij</a>
                        <a class="dropdown-item-custom"  href="#">Repetoire</a>
                        <a class="dropdown-item-custom"  href="#">Koorleden</a>
                    </div>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" style="color: yellow" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Optredens
                    </a>
                    <div class="dropdown-menu bg-danger" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item-custom"  href="#">Album</a>
                        <a class="dropdown-item-custom"  href="#">Muzieklijst</a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " style="color: yellow" href="#">Introductiecursus</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " style="color: yellow" href="#">Agenda</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " style="color: yellow" href="#">Informatie</a>
                </li>
            </ul>
            @if (Route::has('login'))
                <div class=" d-flex">
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
                </div>
            @endif
        </div>
    </nav>
    {{--end header--}}

    <main>
        @yield('content')
    </main>

    {{--start footer--}}
    <footer class="text-center text-lg-start text-white bg-danger">
        <!-- Grid container -->
        <div class="container  pb-0 ">
            <!-- Section: Links -->
            <section class="">
                <!--Grid row-->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">
                            Duketown Barbershop Singers
                        </h6>
                        <p >
                             Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit.
                        </p>
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
                            <a class="text-white"  href="mailto:secretaris@duketownbarbershopsingers.nl"> <u>secretaris@duketownbarbershopsingers.nl</u></a>
                        </p>
                    </div>

                    <!-- Grid column -->
                    <hr class="w-100 clearfix d-md-none"/>

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 m-auto">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                        <p><i class="fas fa-home mr-3"></i> Bordeslaan 191, 5223 MK 's-Hertogenbosch</p>
                        <p><i class="fas fa-envelope mr-3"></i>
                            <a
                                class="text-white"
                                href="mailto:info@duketownbarbershopsingers.nl">
                                <u>info@duketownbarbershopsingers.nl</u>
                            </a>
                        </p>
                        <p><i class="fas fa-phone mr-3"></i> +31 06 22 45 78 37</p>
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
                            Kvk: 2738282
                        </div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-5 col-lg-2 ml-lg-1 text-center text-md-end p-0">
                        <!-- Facebook -->
                        <a
                            class="btn btn-outline-light btn-floating m-1"
                            class="text-white"
                            role="button"
                            href="https://www.facebook.com/DuketownBarbershopSingers"
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
