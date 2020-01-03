<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <title>Export - Import | @yield('title')</title>

    <!-- Font Awesome 5.8.2 -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <!-- MDBootstrap DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('css/addons/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/addons/datatables-select.min.css') }}">
    <!-- MDBootstrap DataTables Select CSS -->
    <link href="{{ asset('css/addons/datatables-select.min.css') }}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
      .map-container{
        overflow:hidden;
        padding-bottom:56.25%;
        position:relative;
        height:0;
      }
      .map-container iframe{
        left:0;
        top:0;
        height:100%;
        width:100%;
        position:absolute;
      }
    </style>

    @stack('styles')
  </head>
  <body class="grey lighten-3">
    <header>
      @include('includes.navbar')
      {{-- @include('includes.sidebar') --}}
    </header>

    <main class="pt-5 mx-lg-5">
      <div class="container-fluid mt-5">
        @include('flash::message')
        @include('partials._alerts')
        
        @yield('content')
      </div>
    </main>
    
    <!-- SCRIPTS -->
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- Select2 -->
    <script type="text/javascript" src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <!-- MDBootstrap DataTables JS -->
    <script type="text/javascript" src="{{ asset('js/addons/datatables.min.js') }}"></script>
    <!-- MDBootstrap DataTables Select JS -->
    <script type="text/javascript" src="{{ asset('js/addons/datatables-select.min.js') }}"></script>
    
    <!-- Initializations -->
    <script type="text/javascript">
      // Animations initialization
      new WOW().init();
    </script>

    {{-- MDBootstrap DataTables --}}
    <script>
      $(document).ready(function () {
        $('#dtBasic').DataTable({
          processing: true,
          language: {
            url: "{{ asset('plugins/Spanish.json') }}"
          },
          lengthMenu: [[25, 50, -1], [25, 50, "Todos"]],
          "order": [[ 1, 'asc' ]],
        });
        $('.dataTables_length').addClass('bs-select');
      });
    </script>

    {{-- MDBootstrap DataTables con Scroll Horizontal y Vertical --}}
    <script>
      $(document).ready(function () {
        $('#dtHorizontalVertical').DataTable({
          processing: true,
          scrollX: true,
          scrollY: 800,
          language: {
            url: "{{ asset('plugins/Spanish.json') }}"
          },
          lengthMenu: [[25, 50, -1], [25, 50, "Todos"]],
          "order": [[ 1, 'asc' ]],
        });
        $('.dataTables_length').addClass('bs-select');
      });
    </script>

    {{-- MDBootstrap DataTables checkbox --}}
    <script>
      $(document).ready(function () {
        $('#dtBasicCheckbox').DataTable({
          processing: true,
          language: {
            url: "{{ asset('plugins/Spanish.json') }}"
          },
          lengthMenu: [[25, 50, -1], [25, 50, "Todos"]],
          "order": [[ 1, 'asc' ]],
          columnDefs: [{
          orderable: false,
            className: 'select-checkbox',
            targets: 0
          }],
          select: {
            style: 'os',
            selector: 'td:first-child'
          }
        });
        $('.dataTables_length').addClass('bs-select');
      });
    </script>

    {{-- Inicializaciones --}}
    <script>
      $(document).ready(function () {
        $(".select2").select2({
          maximumSelectionLength: 2
        });
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>

    @include('sweetalert::alert')

    <script>
      $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
      $('#flash-overlay-modal').modal();
    </script>    

    @stack('scripts')
  </body>
</html>