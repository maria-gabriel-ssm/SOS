 
@if (auth::user())
@if (auth::user()->iactivo !=1 )    
@php
header("Location: " . URL::to('/'), true, 302);
exit();
@endphp  
@endif            
@else
@php
header("Location: " . URL::to('/'), true, 302);
exit();
@endphp 
@endif

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache"> -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <style type="text/css">
        .select2{
            min-width: 100%;
        }
    </style>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard-sos.css') }}" />

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <title>@yield('title')</title>
    <body id="scrole" style="overflow-y: scroll;">
        @yield('content')
    </body>

    </html>
    <script type="text/javascript">

        $(document).ready(function(){
          $("#cat_area").select2({theme: 'bootstrap4'}); 
          $("#cat_tarea").select2({theme: 'bootstrap4'});  
          $("#cat_equipo").select2({theme: 'bootstrap4'});
          $("#cat_dir").select2({theme: 'bootstrap4', width:'100%'});
          $("#cat_sub").select2({theme: 'bootstrap4', width:'100%'});
          $("#cat_dep").select2({theme: 'bootstrap4', width:'100%'});
          $("#cat_sed").select2({theme: 'bootstrap4', width:'100%'});
          $("#cat_rec").select2({theme: 'bootstrap4', width:'100%'});
          $("#cargo").select2({theme: 'bootstrap4', width:'100%'});
      });

  </script>
  <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

<script src="{{ URL::asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ URL::asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
