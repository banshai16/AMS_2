<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/dashboard_style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}" type = "text/css">
    <link rel="stylesheet" href="{{asset('assets/css/leaflet.css')}}" type="text/css">



</head>
<body>
    @include('layout.header')
    @include('layout.sidebar')
    <div class="content" id="content">
      @yield('content')
    </div>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Bootstrap core JavaScript-->
    {{-- <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script> --}}
    {{-- <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}

    <!-- Core plugin JavaScript-->
    {{-- <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script> --}}

    <!-- Custom scripts for all pages-->
    {{-- <script src="{{asset('js/sb-admin-2.min.js')}}"></script> --}}
    {{-- <script src="{{asset('js/sb-admin-2.js')}}"></script> --}}
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/myjs.js')}}"></script>
    <script src="{{asset('assets/js/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/map.js')}}"></script>
    {{-- <script src="{{asset('assets/js/leaflet.js.map')}}"></script> --}}
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    



    <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    {{-- <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> --}}
</body>
</html>