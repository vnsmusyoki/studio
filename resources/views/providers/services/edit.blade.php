@extends('layouts.app')
@section('title', 'Providers | Edit Studio Service')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Edit Studio Service</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('provider.services') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Return
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Edit Service</li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Service Information</h5>
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

                <form class="row gy-3 needs-validation" method="POST" action="{{ route('provider.services.update', $service->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="col-md-6">
                        <label class="form-label">Service Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $service->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select class="form-select @error('category') is-invalid @enderror"
                            name="category">
                            <option value="">Select a Service Category</option>
                            @foreach ($serviceCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $service->category == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Minimum Price</label>
                        <input type="number" step="0.01" name="min_price" class="form-control @error('min_price') is-invalid @enderror" value="{{ old('min_price', $service->min_price) }}">
                        @error('min_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Maximum Price</label>
                        <input type="number" step="0.01" name="max_price" class="form-control @error('max_price') is-invalid @enderror" value="{{ old('max_price', $service->max_price) }}">
                        @error('max_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $service->location) }}">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Service Image</label>
                        <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($service->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $service->image) }}" alt="Service Image" width="120" class="rounded">
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary-600">Update Service</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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
        .catch(error => console.error(error));
</script>
@endsection
