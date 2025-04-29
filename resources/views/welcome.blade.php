<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome - {{ env('APP_NAME') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('front/css/lightgallery.min.css') }}">

    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('front/css/swiper.css') }}">

    <link rel="stylesheet" href="{{ asset('front/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

</head>

<body>

    <div class="site-wrap">

        <div class="site-mobile-menu">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>




        <header class="site-navbar py-3" role="banner">
            @include('layouts.nav')

        </header>

        <div class="container-fluid" data-aos="fade" data-aos-delay="500">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4">

                        <div class="image-wrap-2">
                            <div class="image-info">
                                <h2 class="mb-3">{{ $category->title }}</h2>
                                <a href="{{ route('category-images', $category->id) }} "
                                    class="btn btn-outline-white py-2 px-4">More Photos</a>
                            </div>
                            @php
                                $images = json_decode($category->image, true);
                                $firstImage = $images[0] ?? null;
                            @endphp

                            @if ($firstImage)
                                <img src="{{ asset('storage/' . $firstImage) }}" alt="Image" class="img-fluid">
                            @else
                                <img src="https://fakeimg.pl/600x400" alt="Image" class="img-fluid">
                            @endif

                        </div>

                    </div>
                @endforeach
            </div>
        </div>

        <div class="footer py-4">
            <div class="container-fluid text-center">
                <p>

                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved by <a href="{{ url('/') }}"
                        target="_blank">{{ env('APP_NAME') }}</a>

                </p>
            </div>
        </div>





    </div>

    <script src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('front/js/swiper.min.js') }}"></script>
    <script src="{{ asset('front/js/aos.js') }}"></script>

    <script src="{{ asset('front/js/picturefill.min.js') }}"></script>
    <script src="{{ asset('front/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.mousewheel.min.js') }}"></script>

    <script src="{{ asset('front/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#lightgallery').lightGallery();
        });
    </script>

</body>

</html>
