@extends('app')
@section('content')

    <!-- Hero Section-->
    <section class="hero py-3 text-white dark-overlay">
        <img class="bg-image" src="{{asset('img/photo/banner.jpg')}}" alt="page banner">
        <div class="container overlay-content">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb text-white justify-content-center no-border mb-0">
                <li class="breadcrumb-item">
                    <a href="#">Downloads</a>
                </li>
                <li class="breadcrumb-item active">Facebook Collector Software</li>
            </ol>
            <h1 class="hero-heading">Download Facebook Collector Software</h1>
            <p>Version 1.0 Beta</p>
        </div>
    </section>
    <section class="py-6">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 mx-auto">
                    <h3>Welcome Agent {{Auth::user()->first_name}}</h3>
                    <p>On this page you can download our <b>beta version 1.0</b> of the desktop based software <b>Facebook Data Collector</b>, which you
                        can use remotely to get Facebook users data. Also, by using our software you can collect a bulk
                    of users who commented or reacted on any particular post in a page or a group. Also, you will have the ability to get users joined a particular group.</p>
                    <p>Before using the software please read carefully the <b>Software Documentation</b> file withing the downloaded directory.</p>
                    <h4>Download Now</h4>
                    <p>To download the software please <a href="{{route('frontend.download.facebook_collector.download')}}">Click here</a>.</p>
                </div>
            </div>
        </div>
    </section>
@stop
