<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset("img/favicon.png")}}" rel="shortcut icon">
    <title>{{ \App\Setting::find(1)->web_name }} - {{ $title }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap-datetimepicker.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d64a16c1a6.js" crossorigin="anonymous"></script>
    <!-- Sweetalert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css" integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-search--dropdown .select2-search__field {
            width: 98%;
        }

        th {
            color: #565656 !important;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="header bg-success">
            <div class="header-left">
                <div class="logo-navbar">
                    <h4 style="color: white;">YAZFI GROUP</h4>
                </div>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="{{ asset('/storage/' . auth()->user()->image ) }}" width="40">
                            <span class="status online"></span></span>
                        <span>{{ auth()->user()->name }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                        <a class="dropdown-item" href="{{ route('edit.profile') }}">Edit Profile</a>
                        <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout').submit();">Logout</a>

                        <form id="logout" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                    <a class="dropdown-item" href="{{ route('edit.profile') }}">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    @role('super-admin')
                    <x-admin.sidebar></x-admin.sidebar>
                    @endrole
                    @role('dokter')
                    <x-dokter.sidebar></x-dokter.sidebar>
                    @endrole
                    @role('marketing')
                    <x-marketing.sidebar></x-marketing.sidebar>
                    @endrole
                    @role('finance')
                    <x-resepsionis.sidebar></x-resepsionis.sidebar>
                    @endrole
                    @role('supervisor')
                    <x-supervisor.sidebar></x-supervisor.sidebar>
                    @endrole
                    @role('hrd')
                    <x-hrd.sidebar></x-hrd.sidebar>
                    @endrole
                    @role('logistik')
                    <x-logistik.sidebar></x-logistik.sidebar>
                    @endrole
                    @role('purchasing')
                    <x-purchasing.sidebar></x-purchasing.sidebar>
                    @endrole
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{ asset('/') }}js/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('/') }}js/popper.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}js/jquery.slimscroll.js"></script>
    <script src="{{ asset('/') }}js/app.js"></script>
    <script src="{{ asset('/') }}js/select2.min.js"></script>
    <script src="{{ asset('/') }}js/moment.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Datatables -->
    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>


    <script>
        $('.delete-form').on('click', function(e) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Delete this data ?',
                text: "Are you sure you want to delete this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    return form.submit();
                }
            })
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('footer')
</body>

</html>