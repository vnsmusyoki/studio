@extends('layouts.app')
@section('title', 'Complaints | Add')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Add Complaint</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('client.complains') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Return
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Add New Complaint</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Complaint Information</h5>
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

                    <form class="row gy-3 needs-validation" autocomplete="off" method="POST"
                        action="{{ route('client.complains.store') }}" enctype="multipart/form-data">
                        @csrf



                        <div class="col-md-12">
                            <label class="form-label">Booking</label>
                            <select class="form-select @error('booking_id') is-invalid @enderror" name="booking_id"
                                required>
                                <option value="">Select a Booking</option>
                                @foreach ($bookings as $booking)
                                    <option value="{{ $booking->id }}"
                                        {{ old('booking_id') == $booking->id ? 'selected' : '' }}>
                                        Booking #{{ $booking->id }} - {{ $booking->servicebooking->title }} -
                                        {{ $booking->provider->name }} - {{ $booking->created_at->format('d M Y') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('booking_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Complaint</label>
                            <textarea class="form-control" name="complain" id="complain" rows="5">{{ old('complain') }}</textarea>
                            @error('complain')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Attach Images</label>
                            <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror"
                                id="imageInput" multiple accept="image/*">
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="imagePreview" class="d-flex flex-wrap gap-2 mt-2"></div>
                        </div>


                        <div class="col-12">
                            <button class="btn btn-primary-600" type="submit">
                                Submit Complaint
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
            .create(document.querySelector('#complain'), {
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

        document.getElementById('imageInput').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';

            Array.from(e.target.files).forEach(file => {
                if (!file.type.startsWith('image/')) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('rounded', 'shadow-sm');
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

@endsection
