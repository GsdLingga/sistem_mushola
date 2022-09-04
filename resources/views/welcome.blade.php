<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/nazox/layouts/vertical/pages-maintenance.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Mar 2021 09:17:34 GMT -->
<head>

        <meta charset="utf-8" />
        <title>Homepage</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.cs')}}s" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">

        <div class="home-btn d-none d-sm-block">
            @if (Route::has('login'))
                @auth
                    @if (auth()->user()->role == 'Admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
                    @elseif (auth()->user()->role == 'Pengurus')
                        <a href="{{ route('pengurus.dashboard') }}" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
                    @elseif(auth()->user()->role == 'Guru')
                        <a href="{{ route('guru.dashboard') }}" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
                    @endif
                {{-- <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a> --}}
                @else
                    <a href="{{ route('login') }}" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
                @endauth
            @endif
            {{-- <a href="index.html" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a> --}}
        </div>

        <div class="my-5 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <div class="mb-5">
                                @if (Route::has('login'))
                                    @auth
                                        @if (auth()->user()->role == 'Admin')
                                            <a href="{{ route('admin.dashboard') }}">
                                        @elseif (auth()->user()->role == 'Pengurus')
                                            <a href="{{ route('pengurus.dashboard') }}">
                                        @elseif(auth()->user()->role == 'Guru')
                                            <a href="{{ route('guru.dashboard') }}">
                                        @endif
                                    {{-- <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a> --}}
                                    @else
                                        <a href="{{ route('login') }}">
                                    @endauth
                                @endif
                                {{-- <a href="index.html"> --}}
                                    <img src="{{asset('assets/images/logo.png')}}" alt="logo" height="100" />
                                </a>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-4">
                                    <div class="maintenance-img">
                                        <img src="{{asset('assets/images/maintenance-bg.png')}}" alt="" class="img-fluid mx-auto d-block">
                                    </div>
                                </div>
                            </div>
                            <h3 class="mt-5">Hello</h3>
                            <p>Press the home icon to go to the dashboard.</p>

                            {{-- <div class="row">
                                <div class="col-md-4">
                                    <div class="mt-4 maintenance-box">
                                        <div class="p-3">
                                            <div class="avatar-sm mx-auto">
                                                <span class="avatar-title bg-soft-primary rounded-circle">
                                                    <i class="mdi mdi-access-point-network font-size-24 text-primary"></i>
                                                </span>
                                            </div>

                                            <h5 class="font-size-15 text-uppercase mt-4">Why is the Site Down?</h5>
                                            <p class="text-muted mb-0">There are many variations of passages of
                                                Lorem Ipsum available, but the majority have suffered alteration.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4 maintenance-box">
                                        <div class="p-3">
                                            <div class="avatar-sm mx-auto">
                                                <span class="avatar-title bg-soft-primary rounded-circle">
                                                    <i class="mdi mdi-clock-outline font-size-24 text-primary"></i>
                                                </span>
                                            </div>
                                            <h5 class="font-size-15 text-uppercase mt-4">
                                                What is the Downtime?</h5>
                                            <p class="text-muted mb-0">Contrary to popular belief, Lorem Ipsum is not
                                                simply random text. It has roots in a piece of classical.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4 maintenance-box">
                                        <div class="p-3">
                                            <div class="avatar-sm mx-auto">
                                                <span class="avatar-title bg-soft-primary rounded-circle">
                                                    <i class="mdi mdi-email-outline font-size-24 text-primary"></i>
                                                </span>
                                            </div>
                                            <h5 class="font-size-15 text-uppercase mt-4">
                                                Do you need Support?</h5>
                                            <p class="text-muted mb-0">If you are going to use a passage of Lorem
                                                Ipsum, you need to be sure there isn't anything embar.. <a
                                                        href="mailto:no-reply@domain.com"
                                                        class="text-decoration-underline">no-reply@domain.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- end row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>

<!-- Mirrored from themesdesign.in/nazox/layouts/vertical/pages-maintenance.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Mar 2021 09:17:35 GMT -->
</html>
