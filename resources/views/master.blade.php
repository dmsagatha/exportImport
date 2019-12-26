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
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />


    {{-- <link rel="stylesheet" href="{{ asset('css/addons/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/addons/datatables-select.min.css') }}"> --}}
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
        
        @yield('content')
      </div>
    </main>
    
    <!-- SCRIPTS -->
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- Select2 -->
    <script type="text/javascript" src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>

    <!-- Initializations -->
    <script type="text/javascript">
      // Animations initialization
      new WOW().init();
    </script>

    <script>
      $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
  
        $.extend(true, $.fn.dataTable.defaults, {
          order: [[ 3, 'asc' ]],
          pageLength: 50,
        });

        $('.datatable:not(.ajaxTable)').DataTable({
          buttons: dtButtons,
          language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
          },
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
          $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
        });
      });
    </script>

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

    <script>
      $(document).ready(function () {
        $(".select2").select2({
          maximumSelectionLength: 2
        });
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