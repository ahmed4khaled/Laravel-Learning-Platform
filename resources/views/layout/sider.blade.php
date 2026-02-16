<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assest/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assest/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ Auth::user()->name }} <sup>2</sup></div>
            </a>
            {{-- @dd() --}}
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('profile') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Creation</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Creation</h6>
                        @if (Auth::user()->role === 'Adm')
                            <a class="collapse-item" href="{{ route('Qr') }}">QR</a>
                            <a class="collapse-item" href="{{ route('one') }}">create lec</a>
    <a href="{{ route('dashboard.exams.index') }}" class="collapse-item" >
                            
                            <span>إدارة الامتحانات</span>
                        </a>                            <a class="collapse-item" href="{{ route('profilestd', [1,'Center']) }}">One Sec(Center) </a>
                            <a class="collapse-item" href="{{ route('profilestd', [2,'center']) }}">Two Sec(Center)</a>
                            <a class="collapse-item" href="{{ route('profilestd', [3,'center']) }}">Three Sec(Center)</a>
                            <a class="collapse-item" href="{{ route('Lecs', [2, 1]) }}">حصص ثانيه ثانوي </a>
                            <a class="collapse-item" href="{{ route('Lecs', [2, 4]) }}">الشهور ثانيه ثانوي </a>
                            <a class="collapse-item" href="{{ route('Lecs', [2, 10]) }}">السناتر ثانيه ثانوي </a>
                            <a class="collapse-item" href="{{ route('Lecs', [3, 1]) }}">حصص ثالثه ثانوي </a>
                            <a class="collapse-item" href="{{ route('Lecs', [3, 4]) }}">الشهور ثالثه ثانوي </a>
                            <a class="collapse-item" href="{{ route('Lecs', [3, 10]) }}"> السناتر ثالثه ثانوي</a>
                            <a class="collapse-item" href="{{ route('Lecs', [3,3]) }}">اGeo  </a>

                        @elseif(Auth::user()->role === 'inst')
                            <a class="collapse-item" href="{{ route('profilestd', 1) }}">One Sec</a>
                            <a class="collapse-item" href="{{ route('profilestd', 2) }}">Two Sec</a>
                            <a class="collapse-item" href="{{ route('profilestd', 3) }}">Three Sec</a>
                        @endif

                    </div>
                </div>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->


        </ul>
        <!-- End of Sidebar -->


        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('assest/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assest/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assest/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assest/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src=" {{ asset('assest/vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('assest/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assestjs/demo/chart-pie-demo.js') }}"></script>
