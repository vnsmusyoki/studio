<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME') }} - Images Display</title>
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

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

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



        <div class="site-section" data-aos="fade">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8"
                        role="alert">
                        <div class="d-flex align-items-center justify-content-between text-lg">
                            Success
                            <button class="remove-button text-success-600 text-xxl line-height-1"> <iconify-icon
                                    icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                        </div>
                        <p class="fw-medium text-success-600 text-sm mt-8">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8"
                        role="alert">
                        <div class="d-flex align-items-center justify-content-between text-lg">
                            Error
                            <button class="remove-button text-danger-600 text-xxl line-height-1"> <iconify-icon
                                    icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                        </div>
                        <p class="fw-medium text-danger-600 text-sm mt-8">
                            {{ session('error') }}
                        </p>
                    </div>
                @endif
                <div class="row justify-content-center">

                    <div class="col-md-7">
                        <div class="row mb-5">
                            <div class="col-12 ">
                                <h2 class="site-section-heading text-center">{{ $record->provider->name }} Located at
                                    {{ $record->location }}</h2>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" id="lightgallery">
                    @php
                        $images = json_decode($record->image, true);

                    @endphp
                    @foreach ($images as $image)
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 item" data-aos="fade"
                            data-src="{{ asset('storage/' . $image) }}"
                            data-sub-html="<h4>{{ $record->title }}</h4><p>
                                {!! $record->description !!}
                            </p>">
                            <a href="#"><img src="{{ asset('storage/' . $image) }}" alt="IMage"
                                    class="img-fluid"></a>
                        </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pricing</td>
                                    <td>{{ $record->min_price }} - {{ $record->max_price }}</td>
                                </tr>
                                <tr>
                                    <td>Service</td>
                                    <td>{{ $record->title }}</td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>{{ $record->studio->name }}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>{{ $record->location }}</td>
                                </tr>
                                <tr>
                                    <td>What this package has for you</td>
                                    <td>{!! $record->description !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <form action="{{ route('submit-booking') }}" method="POST" autocomplete="off">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="">Appointment Date</label>
                                <input type="date" class="form-control" name="appointment_date"
                                    value="{{ old('appointment_date') }}">
                                @error('appointment_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Appointment Time</label>
                                <input type="time" class="form-control" name="appointment_time"
                                    value="{{ old('appointment_time') }}">
                                @error('appointment_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Payment Code</label>
                                <input type="text" class="form-control" name="transaction_code"
                                    value="{{ old('transaction_code') }}">
                                @error('transaction_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Notes</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"> {{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="hidden" name="service_booking_id" value="{{ $record->id }}">
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Submit Booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer py-4">
            <div class="container-fluid text-center">
                <p> Copyright &copy;
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
