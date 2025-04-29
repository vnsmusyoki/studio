<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="assets/css/remixicon.css">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="assets/css/lib/bootstrap.min.css">
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="assets/css/lib/apexcharts.css">
    <!-- Data Table css -->
    <link rel="stylesheet" href="assets/css/lib/dataTables.min.css">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="assets/css/lib/editor-katex.min.css">
    <link rel="stylesheet" href="assets/css/lib/editor.atom-one-dark.min.css">
    <link rel="stylesheet" href="assets/css/lib/editor.quill.snow.css">
    <!-- Date picker css -->
    <link rel="stylesheet" href="assets/css/lib/flatpickr.min.css">
    <!-- Calendar css -->
    <link rel="stylesheet" href="assets/css/lib/full-calendar.css">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="assets/css/lib/jquery-jvectormap-2.0.5.css">
    <!-- Popup css -->
    <link rel="stylesheet" href="assets/css/lib/magnific-popup.css">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="assets/css/lib/slick.css">
    <!-- prism css -->
    <link rel="stylesheet" href="assets/css/lib/prism.css">
    <!-- file upload css -->
    <link rel="stylesheet" href="assets/css/lib/file-upload.css">

    <link rel="stylesheet" href="assets/css/lib/audioplayer.css">
    <!-- main css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <section class="auth bg-base d-flex flex-wrap">
        <div class="auth-left d-lg-block d-none">
            <div class="d-flex align-items-center flex-column h-100 justify-content-center">
                <img src="assets/images/camera.jpg" alt="">
            </div>
        </div>
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <center>
                        <a href="/" class="mb-40 max-w-290-px">
                            <img src="assets/images/camera.jpg" alt="" style="height: 100px;">
                        </a>
                    </center>
                    <h4 class="mb-12">Sign Up to your Account</h4>
                </div>
                @php
                    $services = App\Models\ServiceCategory::all();
                @endphp
                <form action="{{ route('register-service-provider') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="icon-field mb-16">
                        <label for="" class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Full Name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="icon-field mb-16">
                        <label for="" class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                            class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Phone Number">
                        @error('phone_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Profile Picture</label>
                        <input class="form-control @error('profile_picture') is-invalid @enderror" type="file"
                            name="profile_picture" accept="image/*" />
                        @error('profile_picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="icon-field mb-16">
                        <label for="" class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="icon-field mb-16">
                        <label for="" class="form-label">Select Service</label>
                        <select name="service_category_id" id="" class="form-control">
                            <option value="">Click to select service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        @error('service_category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-16">
                        <label class="form-label">Upload Portfolio Images (you can upload multiple) </label>
                        <input class="form-control @error('portfolio_images') is-invalid @enderror" type="file"
                            name="portfolio_images[]" multiple accept="image/*" placeholder="Select Images" />
                        @error('portfolio_images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="role" value="provider">
                    <input type="hidden" name="status" value="pending">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Describe about your service</label>
                        <textarea class="form-control" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="position-relative mb-20">
                        <div class="icon-field">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password"
                                class="form-control h-56-px bg-neutral-50 radius-12" id="your-password"
                                placeholder="Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <span
                            class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                            data-toggle="#your-password"></span>
                    </div>
                    <div class="position-relative mb-20">
                        <div class="icon-field">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control h-56-px bg-neutral-50 radius-12" id="your-password"
                                placeholder="Confirm Password">
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <span
                            class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                            data-toggle="#your-password"></span>
                    </div>


                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">
                        Sign Up</button>

                    <div class="mt-32 text-center text-sm">
                        <p class="mb-0">Already have an account? <a href="{{ route('login') }}"
                                class="text-primary-600 fw-semibold">Sign In</a></p>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <!-- jQuery library js -->
    <script src="assets/js/lib/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Apex Chart js -->
    <script src="assets/js/lib/apexcharts.min.js"></script>
    <!-- Data Table js -->
    <script src="assets/js/lib/dataTables.min.js"></script>
    <!-- Iconify Font js -->
    <script src="assets/js/lib/iconify-icon.min.js"></script>
    <!-- jQuery UI js -->
    <script src="assets/js/lib/jquery-ui.min.js"></script>
    <!-- Vector Map js -->
    <script src="assets/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="assets/js/lib/jquery-jvectormap-world-mill-en.js"></script>
    <!-- Popup js -->
    <script src="assets/js/lib/magnifc-popup.min.js"></script>
    <!-- Slick Slider js -->
    <script src="assets/js/lib/slick.min.js"></script>
    <!-- prism js -->
    <script src="assets/js/lib/prism.js"></script>
    <!-- file upload js -->
    <script src="assets/js/lib/file-upload.js"></script>
    <!-- audioplayer -->
    <script src="assets/js/lib/audioplayer.js"></script>

    <!-- main js -->
    <script src="assets/js/app.js"></script>

    <script>
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on('click', function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle('.toggle-password');
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', '|',
                    'bulletedList', 'numberedList', '|',
                    'undo', 'redo'
                ],
                removePlugins: ['MediaEmbed', 'Table', 'TableToolbar']
            })
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>
