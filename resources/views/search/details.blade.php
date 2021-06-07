@extends('app')
@section('content')

    <!-- Hero Section-->
    <section class="hero py-3 text-white dark-overlay">
        <img class="bg-image" src="{{asset('img/photo/banner.jpg')}}" alt="page banner">
        <div class="container overlay-content">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb text-white justify-content-center no-border mb-0">
                <li class="breadcrumb-item">
                    <a href="{{route('frontend.home')}}">Search</a>
                </li>
                <li class="breadcrumb-item active">@if(isset($user)) {{ $user->name }} @else No Result @endif </li>
            </ol>
            <h1 class="hero-heading">@if(isset($user)) {{ $user->name }} @else No Result @endif</h1>
        </div>
    </section>
    <section class="py-6">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 mx-auto">
                    @if(!isset($user))
                        <h2>No Search Result</h2>
                    @else
                        <p><b>Facebook ID:</b> {{$user->fb_id}}</p>
                        <p><b>Name:</b> {{$user->name}}</p>
                        <p><b>Email:</b> {{$user->email}}</p>
                        <p><b>Mobile:</b> {{$user->mobile}}</p>
                        <p><b>Religion:</b> {{$user->religion}}</p>
                        <p><b>Birthday:</b> {{$user->birthday}}</p>
                        <p><b>User Name:</b> {{$user->user_name}}</p>
                        <p><b>Employer:</b> {{$user->employer}}</p>
                        <p><b>Position: </b> {{$user->position}}</p>
                        <p><b>Hometown</b> {{$user->hometown}}</p>
                        <p><b>Location: </b> {{$user->location}}</p>
                        <p><b>Degree: </b> {{$user->degree}}</p>
                        <p><b>Relationship Status:</b> {{$user->relationship_status}}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop
