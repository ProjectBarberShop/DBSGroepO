<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Barbershop | Dashboard</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script type="text/javascript" src="{{ asset('js/adminlts.js') }}" defer></script>
  <script src="https://cdn.tiny.cloud/1/8g15vw4dufcpo94n1f86rvcmv7vqqi7pacte3g6cgy0ln3fb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Datatables bootstrap -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.5.2/css/OverlayScrollbars.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('cms/home')}}" class="nav-link">Home</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('assets/images/barbershop.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Barbershop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
            <a  href="{{url('cms/profile')}}" class="d-block">
                <i class="ion ion-person" style="font-size: 16px"></i> Welkom {{ Auth::user()->name }}</i>
            </a>
            <p></p>
            <a href="{{url('cms/signout')}}" class="d-block">
                <i class="ion-log-out" style="font-size: 16px"></i> Uitloggen</i>
            </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('cms/home')}}" class="nav-link">
              <i class="nav-icon far fa fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('cms/fotos')}}" class="nav-link">
              <i class="nav-icon fas fa fa-image"></i>
              <p>
                Foto's
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('cms/paginas')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Pagina's
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('cms/youtube')}}" class="nav-link">
              <i class="nav-icon far ion ion-ios-videocam"></i>
              <p>
                Video's
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('cms/agenda')}}" class="nav-link">
              <i class="nav-icon far ion ion-ios-calendar"></i>
              <p>
                Agenda
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('cms/contactpersonen')}}" class="nav-link">
              <i class="nav-icon far ion ion-person"></i>
              <p>Contactpersonen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('cms/contactverzoeken')}}" class="nav-link">
              <i class="nav-icon far ion-at"></i>
              <p>Contactverzoeken</p>
              </a>
          </li>
          <li class="nav-item">
            <a href="{{url('cms/nieuwsbrieven')}}" class="nav-link">
              <i class="nav-icon far ion-ios-paper"></i>
              <p>Nieuwsbrieven</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas ion-ios-musical-notes"></i>
              <p>
                LearnToSing
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('cms/learntosing-beheer')}}" class="nav-link">
                  <i class="far ion-ios-list-outline nav-icon"></i>
                  <p>Cursussen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('cms/learntosing/categorie')}}" class="nav-link">
                  <i class="far ion-ios-list-outline nav-icon"></i>
                  <p>Categorie</p>
                </a>
              </li>
            </ul>
          <li class="nav-item">
            <a href="{{url('cms/tickets')}}" class="nav-link">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>Tickets</p>
            </a>
          </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard barbershop</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            @yield('content')
        </div>
    </section>


</div>
<!-- ./wrapper -->
<!-- scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.5.2/js/jquery.overlayScrollbars.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- tinyMc -->
<!-- ./endTinyMc -->
</body>
</html>
