<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>{{ $title or '{? schema.name ?}' }}</title>
  <!-- Favicon-->
  <link rel="icon" href="../../favicon.ico" type="image/x-icon">

  @section('styles')
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Bootstrap Core Css -->
  <link href="{{ asset('vendor/admin-bsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

  <!-- Waves Effect Css -->
  <link href="{{ asset('vendor/admin-bsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="{{ asset('vendor/admin-bsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />

  <!-- Custom Css -->
  <link href="{{ asset('vendor/admin-bsb/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-template/css/style.css') }}" rel="stylesheet">

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="{{ asset('vendor/admin-bsb/css/themes/all-themes.css') }}" rel="stylesheet" />
  @styles
  @show
</head>

<body class="theme-blue">
  <!-- Page Loader -->
  @include('{? view_namespace ?}layout.page-loader')
  <!-- #END# Page Loader -->
  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>
  <!-- #END# Overlay For Sidebars -->
  <!-- Search Bar -->
  <div class="search-bar">
    <div class="search-icon">
      <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
      <i class="material-icons">close</i>
    </div>
  </div>
  <!-- #END# Search Bar -->
  <!-- Top Bar -->
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
        <a href="javascript:void(0);" class="bars"></a>
        <a class="navbar-brand" href="/">
          <img src="{{ asset('admin-template/img/logo-laraspells.png') }}" alt="" class="logo">
          <span>{? schema.name ?}</span>
        </a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse">
        @include('{? view_namespace ?}layout.navbar-nav')
      </div>
    </div>
  </nav>
  <!-- #Top Bar -->
  <section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
      <!-- User Info -->
      @include('{? view_namespace ?}layout.sidebar-user-info')
      
      <!-- #User Info -->
      <!-- Menu -->
      @include('{? view_namespace ?}layout.sidebar-menu')
      <!-- #Menu -->
      <!-- Footer -->
      <div class="legal">
        <div class="copyright">
          &copy; 2016 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
          <b>Version: </b> 1.0.4
        </div>
      </div>
      <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    @include('{? view_namespace ?}layout.right-sidebar')
    <!-- #END# Right Sidebar -->
  </section>

  <section class="content">
    <div class="container-fluid">
      @yield('content')
    </div>
  </section>

  <!-- Jquery Core Js -->
  @section('scripts')
  <script src="{{ asset('vendor/admin-bsb/plugins/jquery/jquery.min.js') }}"></script>

  <!-- Bootstrap Core Js -->
  <script src="{{ asset('vendor/admin-bsb/plugins/bootstrap/js/bootstrap.js') }}"></script>

  <!-- Select Plugin Js -->
  <script src="{{ asset('vendor/admin-bsb/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

  <!-- Slimscroll Plugin Js -->
  <script src="{{ asset('vendor/admin-bsb/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="{{ asset('vendor/admin-bsb/plugins/node-waves/waves.js') }}"></script>

  <!-- Custom Js -->
  <script src="{{ asset('vendor/admin-bsb/js/admin.js') }}"></script>

  @scripts

  <!-- Demo Js -->
  <script src="{{ asset('vendor/admin-bsb/js/demo.js') }}"></script>

  @show
</body>

</html>