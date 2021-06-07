@extends('app')
@section('content')
    <section class="hero-home">
        <div class="swiper-container hero-slider">
            <div class="swiper-wrapper dark-overlay">
                <div class="swiper-slide"
                     style="background-image:url({{asset('img/photo/data-center.jpg')}})"></div>
                <div class="swiper-slide"
                     style="background-image:url({{asset('img/photo/data-center-2.jpg')}})"></div>
                <div class="swiper-slide"
                     style="background-image:url({{asset('img/photo/data-center-3.jpg')}})"></div>
            </div>
        </div>
        <div class="container py-6 py-md-7 text-white z-index-20">
            <div class="row">
                <div class="col-xl-10">
                    <div class="text-center text-lg-left">
                        <p class="subtitle letter-spacing-4 mb-2 text-white text-shadow">Search for millions of users personal and contact data.</p>
                        <h1 class="display-3 font-weight-bold text-shadow">E3mel Business Users Database</h1>
                    </div>
                    <div class="search-bar mt-5 p-3 p-lg-1 pl-lg-4">
                        {!! Form::open(['method' => 'GET', 'route' => ['frontend.search']]) !!}
                        @csrf
                            <div class="row">
                                <div class="col-lg-7 d-flex align-items-center form-group">
                                    <input class="form-control border-0 shadow-0" type="text" name="q"
                                           placeholder="What are you searching for?">
                                </div>
                                <div class="col-lg-3 d-flex align-items-center form-group no-divider">
                                    <select class="selectpicker" name="type" title="Categories" data-style="btn-form-control">
                                        <option value="fb_id">Facebook ID</option>
                                        <option value="mobile">Mobile Number</option>
                                        <option value="user_name">Userame</option>
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
@section('scripts')
    <script>
        $(document).ready(function(){
            $("#submit").click(function(){
                $("div.spanner").addClass("show");
                $("div.overlay").addClass("show");
            });
        });
    </script>
@stop
