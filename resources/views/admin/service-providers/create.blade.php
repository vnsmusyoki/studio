@extends('layouts.app')
@section('title', 'Admin | Add Service Provider')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Add Service Provider</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('admin.providers') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Return
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Add New Service Provider</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Service Provider Information</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="row gy-3 needs-validation" autocomplete="off" enctype="multipart/form-data" method="POST"
                        action="{{ route('admin.providers.store') }}">
                        @csrf

                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                value="{{ old('name') }}" required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                value="{{ old('email') }}" required />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input class="form-control @error('phone_number') is-invalid @enderror" type="text"
                                name="phone_number" value="{{ old('phone_number') }}" required />
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Profile Picture</label>
                            <input class="form-control @error('profile_picture') is-invalid @enderror" type="file"
                                name="profile_picture" accept="image/*" />
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Service Category</label>
                            <select class="form-select @error('service_category_id') is-invalid @enderror"
                                name="service_category_id" required>
                                <option value="">Select a Service Category</option>
                                @foreach ($serviceCategories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('service_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Describe about your service</label>
                            <textarea class="form-control" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Portfolio Images (you can upload multiple)</label>
                            <input class="form-control @error('portfolio_images') is-invalid @enderror" type="file"
                                name="portfolio_images[]" multiple accept="image/*" />
                            @error('portfolio_images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" required />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation" required />
                        </div>

                        <input type="hidden" name="role" value="provider">
                        <input type="hidden" name="status" value="pending">

                        <div class="col-12">
                            <button class="btn btn-primary-600" type="submit">
                                Add Service Provider
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
@endsection
