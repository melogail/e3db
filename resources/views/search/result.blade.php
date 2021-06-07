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
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Facebook ID</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Profile</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$user->fb_id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->mobile}}</td>
                                <td><a href="https://facebook.com/{{$user->fb_id}}" target="_blank">View Profile</a></td>
                                <td><a href="{{route('frontend.search.details', base64_encode($user->fb_id))}}" target="_blank">More Details</a></td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop

