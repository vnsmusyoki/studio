@extends('layouts.app')
@section('title', 'Service Providers')

@section('content')
    <div class="card h-100 p-0 radius-12">


        <div class="card-body p-24">
            @if ($complains->count())
                <div class="row gy-4">
                    @foreach ($complains as $complain)
                        <div class="col-md-6 col-lg-4">
                            <div class="card border shadow-sm h-100 radius-12 p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0 text-primary">#{{ $complain->booking->servicebooking->title }}
                                    </h6>
                                    <span
                                        class="badge
                                    {{ $complain->status == 'solved' ? 'bg-success' : 'bg-danger text-dark' }}">
                                        {{ ucfirst($complain->status) }}
                                    </span>
                                </div>

                                <p class="text-muted mb-1">
                                    <strong>Client:</strong> {{ $complain->client->name }}
                                </p>
                                <p class="text-muted mb-1">
                                    <strong>Provider:</strong> {{ $complain->provider->name }}
                                </p>

                                <div class="mb-2">
                                    <strong>Complaint:</strong>
                                    <div class="border p-2 rounded bg-light small text-muted">{!! strip_tags($complain->complain) !!}</div>
                                </div>

                                @if ($complain->response)
                                    <div class="mb-2">
                                        <strong>Response:</strong>
                                        <div class="border p-2 rounded bg-light small text-success">{!! strip_tags($complain->response) !!}
                                        </div>
                                    </div>
                                @endif

                                @if ($complain->images)
                                    @php $images = explode(',', $complain->images); @endphp
                                    <div class="mb-2">
                                        <strong>Attachments:</strong>
                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                            @foreach ($images as $img)
                                                <a href="{{ asset('storage/' . $img) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail"
                                                        style="width: 60px; height: 60px; object-fit: cover;">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if ($complain->status == 'pending')
                                    <a href="{{ route('providers.complains.edit', $complain->id) }}"
                                        class="btn btn-sm btn-outline-primary w-100">Edit Response</a>
                                @endif
                                

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted">No complaints submitted yet.</p>
            @endif
        </div>
    </div>
@endsection
