@extends('layouts.app')
@section('title', 'Client | Add New Booking')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Add Client Booking</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('admin.providers') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Return
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Add New Client Booking</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Client Booking Information</h5>
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
                        action="{{ route('client.bookings.store') }}">
                        @csrf


                        <div class="col-md-12">
                            <label class="form-label">Service Booking</label>
                            <select name="service_booking_id" id="" class="form-control">
                                <option value="">Click to select</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->min_price }} -
                                        {{ $service->max_price }} - {{ $service->provider->name }} -
                                        {{ $service->location }}</option>
                                @endforeach
                            </select>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Appointment Time</label>
                            <input class="form-control @error('appointment_time') is-invalid @enderror" type="time"
                                name="appointment_time" value="{{ old('appointment_time') }}" required />
                            @error('appointment_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="form-label">Appointment Date</label>
                            <input class="form-control @error('appointment_date') is-invalid @enderror" type="date"
                                name="appointment_date" accept="image/*" />
                            @error('appointment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-12">
                            <label class="form-label">Provide more information about your appointment</label>
                            <textarea class="form-control" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Transaction Code</label>
                            <input class="form-control @error('transaction_code') is-invalid @enderror" type="text"
                                name="transaction_code" style="text-transform: uppercase" />
                            @error('transaction_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary-600" type="submit">
                                Add Booking
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
