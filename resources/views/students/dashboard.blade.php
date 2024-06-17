@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('theme2/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme2/css/owl.theme.default.min.css') }}">
@endsection

@section('js')
<script src="{{ asset('theme2/js/owl.carousel.min.js') }}"></script>
<script>
var siteCarousel = function () {
    if ($('.nonloop-block-13').length > 0) {
        $('.nonloop-block-13').owlCarousel({
            center: false,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 0,
            autoplay: true,
            nav: true,
            navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">'],
            responsive: {
                600: {
                    margin: 0,
                    nav: true,
                    items: 2
                },
                1000: {
                    margin: 0,
                    stagePadding: 0,
                    nav: true,
                    items: 3
                },
                1200: {
                    margin: 0,
                    stagePadding: 0,
                    nav: true,
                    items: 4
                }
            }
        });
    }
    if ($('.nonloop-block-14').length > 0) {
        $('.nonloop-block-14').owlCarousel({
            center: false,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 0,
            autoplay: true,
            dots: false,
            nav: false,
            navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">'],
            responsive: {
                600: {
                    margin: 20,
                    nav: true,
                    items: 2
                },
                1000: {
                    margin: 30,
                    stagePadding: 20,
                    nav: true,
                    items: 2
                },
                1200: {
                    margin: 30,
                    stagePadding: 20,
                    nav: true,
                    items: 2
                }
            }
        });

        $('.customNextBtn').click(function () {
            $('.nonloop-block-14').trigger('next.owl.carousel');
        });
        $('.customPrevBtn').click(function () {
            $('.nonloop-block-14').trigger('prev.owl.carousel');
        });
    }
    $('.slide-one-item').owlCarousel({
        center: false,
        items: 1,
        loop: true,
        smartSpeed: 900,
        autoplayTimeout: 7000,
        stagePadding: 0,
        margin: 0,
        autoplay: true,
        nav: true,
        navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">'],
    });
    $('.slide-one-item').on('translated.owl.carousel', function (event) {
        console.log('translated');
        $('.owl-item.active').find('.js-slide-text').addClass('active');
    });
    $('.slide-one-item').on('translate.owl.carousel', function (event) {
        console.log('translate');
        $('.owl-item.active').find('.js-slide-text').removeClass('active');
    });
    $('.owl-item.active').find('.js-slide-text').addClass('active');
};
siteCarousel();
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="intro-section bg-white py-5" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>Welcome, {{ Auth::user()->name }}</h1>
                    <p class="lead">Thank you for using our booking system</p>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light py-5" id="course-section">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-7 text-center">
                    <h2 class="section-title">Courses</h2>
                    <p>Please select the course you are most interested in from the options below</p>
                </div>
            </div>
            <div class="row">
                @foreach ($subjects as $subject)
                <div class="col-md-3 mb-4">
                    <div class="card bg-info text-white text-center">
                        <a href="{{ route('student.course.show',$subject->id) }}" class="text-white text-decoration-none">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">{{ $subject->name }}</h5>
                                <p class="card-text">({{ $subject->level->name }})</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="site-section bg-white py-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-7 text-center">
                    <h2 class="section-title">Price</h2>
                    <p>If you continue after the trial lesson, the fees are as follows:</p>
                </div>
            </div>
            <div class="row">
                @foreach ($packages->slice(1) as $package)
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">{{ $package->title }}</h5>
                            <p class="card-text">{{ number_format($package->fees, 0) }} $ per person</p>
                            <a href="{{ route('student.package.buy', $package->id) }}" class="btn btn-primary">Buy Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="site-section bg-light py-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-7 text-center">
                    <h2 class="section-title">Lecturer Introduction</h2>
                    <p>At C-School, we carefully select teachers and provide classes after training them to teach languages to foreigners at our school.</p>
                </div>
            </div>
            <div class="row">
                @foreach ($teachers as $teacher)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('images/Teacher.png') }}" alt="Teacher image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $teacher->user->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $teacher->getTeachSubjects() }}</h6>
                            <p class="card-text">{{ $teacher->responsibility }}</p>
                            <a href="{{ route('student.teachers.detail', $teacher->id) }}" class="btn btn-primary">Teacher Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
