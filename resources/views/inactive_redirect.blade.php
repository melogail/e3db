@extends('app')
@section('content')

    <!-- Hero Section-->
    <section class="hero py-3 text-white dark-overlay">
        <img class="bg-image" src="{{asset('img/photo/banner.jpg')}}" alt="page banner">
        <div class="container overlay-content">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb text-white justify-content-center no-border mb-0">
                <li class="breadcrumb-item">
                    <a href="#">OPPS!!</a>
                </li>
                <li class="breadcrumb-item active">Suspended account</li>
            </ol>
            <h1 class="hero-heading">OPPS!! Supended Account</h1>
        </div>
    </section>
    <section class="py-6">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 mx-auto">
                    <h3 class="text-center">Your account is suspended!</h3>
                    <p>We are sorry to inform you that your account is suspended, please contact the administration
                    for more details.</p>
                    <p>Contact administration and send a ticket <a href="#">Click here</a>.</p>
                </div>
            </div>
        </div>
    </section>
@stop
