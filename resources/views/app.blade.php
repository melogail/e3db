<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.bootstrapious.com/directory/1-6-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 09:55:11 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Directory Theme by Bootstrapious</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Price Slider Stylesheets -->
    <link rel="stylesheet" href="{{asset('vendor/nouislider/nouislider.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Google fonts - Playfair Display-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700">
    <!-- Google fonts - Poppins-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,700">
    <!-- swiper-->
    <link rel="stylesheet" href="{{asset('vendor/ajax/libs/Swiper/4.4.1/css/swiper.min.css')}}">
    <!-- Magnigic Popup-->
    <link rel="stylesheet" href="{{asset('vendor/magnific-popup/magnific-popup.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('css/style.default.32cd9ba6.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('css/custom.0a822280.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body style="padding-top: 72px;">
<header class="header">
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a class="navbar-brand py-1" href="{{route('frontend.home')}}">
                    <img src="{{asset('img/logo.png')}}" alt="Directory logo"></a>
            </div>
            <!-- Navbar Collapse -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('frontend.home')}}">Search User Data</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{route('frontend.search.batch.post')}}">Search Post</a>--}}
{{--                    </li>--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" id="homeDropdownMenuLink" href="#"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            Welcome {{Auth()->user()->username}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="homeDropdownMenuLink">
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superuser')
                                <a class="dropdown-item" target="_blank" href="{{route('admin.dashboard')}}">Dashboard</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- /Navbar -->
</header>

@yield('content')

<!-- Footer-->
<footer class="position-relative z-index-10 d-print-none">
    <!-- Copyright section of the footer-->
    <div class="py-4 font-weight-light bg-gray-800 text-gray-300">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <p class="text-sm mb-md-0 text-center">&copy; 2021, <a href="https://www.e3melbusiness.com/"
                                                                           target="_blank">E3mel Business</a>. All
                        rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="overlay"></div>
<div class="spanner">
    <div class="loader"></div>
    <p>Searching for user data, please wait...</p>
</div>

<!-- jQuery -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap JS bundle - Bootstrap + PopperJS-->
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Magnific Popup - Lightbox for the gallery-->
<script src="{{asset('vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<!-- Smooth scroll -->
<script src="{{asset('vendor/smooth-scroll/smooth-scroll.polyfills.min.js')}}"></script>
<!-- Bootstrap Select -->
<script src="{{asset('vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<!-- Object Fit Images - Fallback for browsers that don't support object-fit-->
<script src="{{asset('vendor/object-fit-images/ofi.min.js')}}"></script>
<!-- Swiper Carousel -->
<script src="{{asset('vendor/ajax/libs/Swiper/4.4.1/js/swiper.min.js')}}"></script>
<script src="{{asset('vendor/jquery.cookie/jquery.cookie.js')}}"></script>
<script src="{{asset('js/demo.36f8799a.js')}}"></script>
<script>var basePath = ''</script>
<!-- Main Theme JS file    -->
<script src="{{asset('js/theme.55f8348b.js')}}"></script>

@yield('scripts')

</body>
</html>
