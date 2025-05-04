{{-- resources/views/admin/complains/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Edit Complaint Response')

@section('content')
<div class="card radius-12">
    <div class="card-header">
        <h5 class="mb-0">Respond to Complaint</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('providers.complains.update', $complain->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label><strong>Client Name:</strong></label>
                <p class="form-control-plaintext">{{ $complain->client->name }}</p>
            </div>

            <div class="mb-3">
                <label><strong>Provider Name:</strong></label>
                <p class="form-control-plaintext">{{ $complain->provider->name }}</p>
            </div>

            <div class="mb-3">
                <label><strong>Service:</strong></label>
                <p class="form-control-plaintext">{{ $complain->booking->servicebooking->title }}</p>
            </div>

            <div class="mb-3">
                <label><strong>Complaint:</strong></label>
                <div class="border p-2 rounded bg-light">{!! $complain->complain !!}</div>
            </div>

            <div class="mb-3">
                <label for="response" class="form-label"><strong>Response:</strong></label>
                <textarea name="response" id="response" rows="6" class="form-control @error('response') is-invalid @enderror">{{ old('response', $complain->response) }}</textarea>
                @error('response')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label"><strong>Status:</strong></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="pending" {{ $complain->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="solved" {{ $complain->status == 'solved' ? 'selected' : '' }}>Solved</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Response</button>
            <a href="{{ route('provider.complains') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
