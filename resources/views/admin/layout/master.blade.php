<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Dreams Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('admin/assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ URL::to('admin/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ URL::to('admin/assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ URL::to('admin/assets/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ URL::to('admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('admin/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ URL::to('admin/assets/css/style.css') }}">
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">

        @include('admin.layout.header')

        @include('admin.layout.sidebar')

        @yield('content')

    </div>


    <script src="{{ URL::to('admin/assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ URL::to('admin/assets/js/feather.min.js') }}"></script>

    <script src="{{ URL::to('admin/assets/js/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ URL::to('admin/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('admin/assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ URL::to('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ URL::to('admin/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::to('admin/assets/plugins/apexchart/chart-data.js') }}"></script>

    <script src="{{ URL::to('admin/assets/js/script.js') }}"></script>
</body>

</html>
