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
                <li class="breadcrumb-item">batch</li>
                <li class="breadcrumb-item active">Post</li>
            </ol>
            <p>Search Batch of Users</p>
        </div>
    </section>
    <section class="py-6">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 mx-auto">
                    <p>To collect a batch of users from facebook post, add the post link in the search bar, then select from the dropdown whether you
                        want to collect users from post reacts or post comments.</p>
                </div>
                <div class="col-sm-12 col-md-12 mx-auto">
                    <div class="search-bar mt-5 p-3 p-lg-1 pl-lg-4">
                        {!! Form::open(['method' => 'POST', 'route' => ['frontend.search.batch.post.collect']]) !!}
                        @csrf
                        <div class="row">
                            <div class="col-lg-7 d-flex align-items-center form-group">
                                <input class="form-control border-0 shadow-0" type="text" name="q"
                                       placeholder="What are you searching for?">
                            </div>
                            <div class="col-lg-3 d-flex align-items-center form-group no-divider">
                                <select class="selectpicker" name="type" title="Collect From..." data-style="btn-form-control">
                                    <option value="reacts">Reacts</option>
                                    <option value="mobile">Comments</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-primary btn-block rounded-xl h-100" id="submit" type="submit">Search
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

